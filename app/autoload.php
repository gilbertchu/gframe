<?php

$exenv = require BASE_PATH."/.env.php";
foreach ($exenv as $key => $value) {
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
    putenv("{$key}={$value}");
}

require BASE_PATH.'/vendor/autoload.php';

/*
spl_autoload_register(function ($class) {
    $prefix = 'GilbertApp\\';
    $base_dir = APP_PATH . '/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});
*/

/*
abstract class Access {
	protected static $app;

	public static function getApp()
	{
		return static::$app;
	}

	public static function setApp($app)
	{
		static::$app = $app;
	}
}

Access::setApp($app);
*/

?>