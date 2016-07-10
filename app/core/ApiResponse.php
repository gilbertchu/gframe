<?php

class ApiResponse {
	public $headerCodes;

	function __construct() {
		$this->headerCodes = [
			200 => $_SERVER["SERVER_PROTOCOL"].' 200 OK',
			201 => $_SERVER["SERVER_PROTOCOL"].' 201 Created',
			202 => $_SERVER["SERVER_PROTOCOL"].' 202 Accepted',
			400 => $_SERVER["SERVER_PROTOCOL"].' 400 Bad Request',
			401 => $_SERVER["SERVER_PROTOCOL"].' 401 Unauthorized',
			403 => $_SERVER["SERVER_PROTOCOL"].' 403 Forbidden',
			404 => $_SERVER["SERVER_PROTOCOL"].' 404 Not Found',
			413 => $_SERVER["SERVER_PROTOCOL"].' 413 Payload Too Large',
			500 => $_SERVER["SERVER_PROTOCOL"].' 500 Internal Server Error',
		];
	}

	//JSON response (default status 200)
	public function rjson($code = 200) {
		$data = (func_num_args()>1) ? func_get_args() : func_get_arg(0);
		if ($this->headerCodes[$code]) header($this->headerCodes[$code], true, $code);
		header('Content-Type: application/json');
		echo json_encode(['success'=>true, 'data'=> $data]);
		return true;
	}

	//JSON response with error (default status 400)
	public function rjsone($code = 400, $data = null) {
		http_response_code($code);
		if ($this->headerCodes[$code]) header($this->headerCodes[$code], true, $code);
        header('Content-Type: application/json; charset=UTF-8');
        if (!$data) $data = $this->headerCodes[$code];
        echo json_encode(['success'=>false, 'code'=>$code, 'data'=>$data]);
        return true;
	}

	//Parse and return input data
	public function ijson() {
		$json = file_get_contents('php://input');
		if (!isset($json)) return $this->rjsone(400, 'Invalid Input');
		$obj = json_decode($json, true);
		return $obj;
	}
}

?>