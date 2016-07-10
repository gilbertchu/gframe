<?php
//testing session auth




?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<style>
body {
	background: #000;
	color: #ddd;
	font-family: "Open Sans", Helvetica, Arial, sans-serif;
}
</style>
</head>
<body>

<h2>Testing Auth</h2>
<p>Not yet finished!</p>

<script>
//TODO
$(function(){
	var store = store || {};

	/*
	* Sets the jwt to the store object
	*/
	store.setJWT = function(data){
		this.JWT = data;
	}

	/*
	* Submit the login form via ajax
	*/
	$("#frmLogin").submit(function(e){
		e.preventDefault();
		$.post('auth/token', $("#frmLogin").serialize(), function(data){
			store.setJWT(data.JWT);
		}).fail(function(){
			alert('error');
		});
	});
});
</script>
</body>
</html>