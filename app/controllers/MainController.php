<?php

class MainController extends Controller {
	protected $view;

	function __construct() {
		$this->view = new View();
		//$client = new GuzzleHttp\Client();
		//$db = new DB();
	}

	public function get_test($param) {
		return $this->view->make('test.php', ['param' => $param]);
	}
}

?>