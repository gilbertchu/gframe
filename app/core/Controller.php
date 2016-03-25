<?php

abstract class Controller {
	public function callController($method, $action, $params = array()) {
		$fname = $action;
		return call_user_func_array(array($this, $fname), $params);
	}
}

?>