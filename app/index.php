<?php

define("APP_MODE", "web");
define("APP_PATH", __DIR__);
define ("BASE_PATH", realpath(__DIR__.'/..'));

require_once APP_PATH.'/autoload.php';

$app = new GilbertApp(false);

require_once APP_PATH.'/config/routes.php';

$app->run();

?>