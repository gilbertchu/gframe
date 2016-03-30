<?php

class AdminController extends Controller {
	protected $view;

	function __construct() {
		$this->view = new View();
	}

	public function get_apcu($clear = 0) {
		if ($clear==1) {
			apcu_clear_cache();
			echo "Cache cleared<br>";
		}
		//testOut(apcu_cache_info());
		$cache = apcu_cache_info();
		foreach ($cache['cache_list'] as $c) {
			testOut(apcu_fetch($c['info']));
		}
	}

	public function get_opcache() {
		$this->view->make('opcache.php');
	}
}

?>