<?php

class View {
	public function make($view, $params = false, $cache = false) {
		if ($params) {
			foreach ($params as $k => $v) {
				$$k = $v;
			}
		}
		ob_start();
		require sprintf("%s/views/%s", APP_PATH, $view);
		return ob_get_flush();
	}

	/*
	public function ijson() {
		//TODO need 404 view
		$json = file_get_contents('php://input');
		if (!isset($json)) return $this->rjsone(400, 'Invalid Input');
		$obj = json_decode($json, true);
		return $obj;
	}
	*/
}

?>