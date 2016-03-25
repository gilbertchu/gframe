<?php

http_response_code(404);

?>

<!DOCTYPE html>
<html>
<head>
<title>Error 404</title>
<style>
body {
	background: #000;
	color: #ddd;
	font-family: "Open Sans", Helvetica, Arial, sans-serif;
}
</style>
</head>
<body>

<h2>Error 404</h2>

<p>The page does not exist. <a href="<?php echo getenv('ENVIRONMENT_DOMAIN'); ?>">Return to home.</a></p>

</body>
</html>