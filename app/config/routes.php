<?php

$app->controller('Main');
$app->get('/test/#param', 'Main', 'test');

?>