<?php

$app->controller('Api', 'token');
$app->route('get', '/test', 'Api', 'test');
$app->route('post', '/phone/forward', 'Api', 'twilio');

?>