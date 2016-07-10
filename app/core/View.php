<?php

class View {
	//Generate a view (optional params)
	public function make($view, $params = false) {
		if ($params) {
			foreach ($params as $k => $v) {
				$$k = $v;
			}
		}
		ob_start();
		require sprintf("%s/views/%s", APP_PATH, $view);
		return ob_get_flush();
	}

	//Redirect to an internal path (default status 307)
	public function redirect($path, $code=307) {
		header('Location: '.getenv('ENVIRONMENT_DOMAIN').$path, true, $code);
		return true;
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