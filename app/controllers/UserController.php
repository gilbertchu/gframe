<?php

class UserController extends Controller {
	protected $view;

	function __construct() {
		$this->view = new View();
	}

	public function get_test() {
		//TODO
		return $this->view->make('test_user.php');
	}
}

?>