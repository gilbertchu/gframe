<?php
//testing session auth




?>

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