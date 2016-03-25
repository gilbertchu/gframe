<?php

function testOut($tv) {
	if (APP_MODE === "api") return;
	if (is_array($tv) || is_object($tv)) {
		echo "<pre>";
		print_r($tv);
		echo "</pre>";
	} else echo $tv;
	echo "<br>----------<br>";
}

function dparam($p, $d=0) {
	echo (isset($p)) ? $p : $d;
}

function lputenv($key, $value) {
	$_ENV[$key] = $value;
	$_SERVER[$key] = $value;
	putenv("{$key}={$value}");
}

?>