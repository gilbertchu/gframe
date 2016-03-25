<?php

define("APP_MODE", "api");
define("APP_PATH", __DIR__);
define ("BASE_PATH", realpath(__DIR__.'/..'));

require_once APP_PATH.'/autoload.php';

$app = new GilbertApp(true);

require_once APP_PATH.'/config/api_routes.php';

$app->run();

?>