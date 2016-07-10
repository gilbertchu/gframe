<?php

class Session {
	private static $cache_duration = 60*60*24*30; //Default 30 days
	private static $instance;
	private static $session;
	private static $sessionKey;

	//Load all cache data
    public static function init() {
    	//Get redis client for cache
    	if (!Redis::tryConnect()) return null;

    	//Check for existing session, starting with cookie
    	$cookieKey = getenv('SESSION_COOKIE');
    	if (isset($_COOKIE[$cookieKey])) {
    		//Decrypt cookie to get session ID
    		if ($sessionID = openssl_decrypt($_COOKIE[$cookieKey], getenv('SESSION_CRYPT'), getenv('SECRET_KEY'))) {
    			//Get session key from prefix and ID
    			static::$sessionKey = getenv('SESSION_PREFIX').$sessionID;
    			//Get cache data with key
	    		if ($data = Redis::client()->get($sessionKey)) {
	    			//Decode data and store as assoc array
	    			static::$session = json_decode($data, true);
	    			//If everything was successful and _start value exists, return
	    			if (isset(static::$session) && isset(static::$session['_start'])) return true;
	    		}
    		}
    	}

    	//Otherwise, create new session if none found
    	if ($_SERVER['HTTP_USER_AGENT'] && $_SERVER['REMOTE_ADDR']) {
    		//Generate unique hash for ID
    		$pre_sha = implode('.', [$_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR'], microtime()]);
    		$sessionID = hash('sha256', $pre_sha);
    		static::$sessionKey = getenv('SESSION_PREFIX').$sessionID;
    		//Encrypt cookie data
    		if ($cookieData = openssl_encrypt($sessionID, getenv('SESSION_CRYPT'), getenv('SECRET_KEY'))) {
    			//Set cookie
    			if (setcookie(getenv('SESSION_COOKIE'), $cookieData, 0, '/', getenv('SESSION_DOMAIN'))) {
	    			//Initialize session cache data with start time
	    			static::$session = ['_start' => time()];
	    			Redis::client()->setex(static::$sessionKey, static::$cache_duration, json_encode(static::$session));
	    			return true;
	    		}
    		}
    	}

    	//If all else fails, remove session key
    	static::$sessionKey = null;
    	return false;
    }

    //Store a value by key
    public static function put($key, $val) {
    	static::$session[$key] = $val;
    	return static::cache();
    }

    //Get a value by key (optional default value none exists)
    public static function get($key, $default = null) {
    	if (!isset(static::$session[$key]) || !array_key_exists($key, static::$session)) {
    		return $default;
    	}
    	return static::$session[$key];
    }

    //Unset a value by key
    public static function forget($key) {
    	if (isset(static::$session[$key]) || array_key_exists($key, static::$session)) {
    		unset(static::$session[$key]);
    		return static::cache();
    	}
    	return true;
    }

    //Wipe the entire session
    public static function flush() {
    	if (null === static::$session) return null;
    	static::$session = null;
    	if (null === static::$sessionKey) return false;
    	Redis::client()->del(static::$sessionKey);
    	static::$sessionKey = null;
    	return true;
    }

    //Update server cache
    private static function cache() {
    	if (!isset(static::$sessionKey)) return null;
    	static::$session['_updated'] = time();
    	if ($store = json_encode(static::$session)) {
    		Redis::client()->set(static::$sessionKey, $store);
    		return true;
    	}
    	return false;
    }

    //Misc singleton implementation
    protected function __construct() {}
	private function __clone() {}
	private function __wakeup() {}
}

?>