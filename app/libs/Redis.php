<?php

class Redis {
	private static $instance;

	public static function client() {
        if (null === static::$instance) {
            $settings['scheme'] = getenv('REDIS_SCHEME');
            if ($settings['scheme'] === 'unix') {
                $settings['path'] = getenv('REDIS_UNIX_PATH');
            } else {
                $settings['host'] = getenv('REDIS_HOST');
                $settings['port'] = getenv('REDIS_PORT');
            }

            static::$instance = new Predis\Client($settings);
        }
        return static::$instance;
    }

    public static function tryConnect() {
        if (null === static::$instance) {
            static::client();
        }

        try {
            static::$instance->connect();
            return true;
        } catch (Predis\Connection\ConnectionException $exception) {
            static::$instance = null;
            return false;
        }
    }

    protected function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
}

?>