<?php

class UserController extends Controller {
	protected $view;

	function __construct() {
		$this->view = new View();
	}

	/*
	public function get_other() {
		testOut(apcu_cache_info());
	}
	*/
}

?>