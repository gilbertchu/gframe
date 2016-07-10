<?php

define("APP_MODE", "web");
define("APP_PATH", __DIR__);
define ("BASE_PATH", realpath(__DIR__.'/..'));

require_once APP_PATH.'/autoload.php';

$app = new GilbertApp(false);

require_once APP_PATH.'/config/routes.php';

if (!$app->run()) {
	switch (getenv('ENVIRONMENT_SETTING')) {
		case 'production':
			break;
		case 'dev':
			//Show a stack trace?
			debug_print_backtrace();
			break;
	}
}

?>