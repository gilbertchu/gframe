<?php

$app->controller('Main');
$app->get('/test/#param', 'Main', 'test');

$app->controller('Admin', 'token');
$app->get('/admin/apcu/#option', 'Admin', 'apcu');
$app->get('/admin/opcache', 'Admin', 'opcache');

/*
$app->controller('User', 'jwt');
$app->get('/user/login', 'Main', 'login');
$app->get('/user/test', 'User', 'test');
*/

?>