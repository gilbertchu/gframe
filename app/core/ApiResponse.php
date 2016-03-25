<?php

class ApiResponse {
	public $headerCodes;

	function __construct() {
		$this->headerCodes = array(400 => 'HTTP/1.1 400 Bad Request',
									500 => 'HTTP/1.1 500 Internal Server Error',
									403 => 'HTTP/1.1 403 Forbidden',
									404 => 'HTTP/1.1 404 Not Found');
	}

	public function rjson() {
		$data = (func_num_args()>1) ? func_get_args() : func_get_arg(0);
		header('Content-Type: application/json');
		echo json_encode(['success'=>true, 'data'=> $data]);
	}

	public function rjsone($code = 400, $data) {
		http_response_code($code);
		if ($this->headerCodes[$code]) header($this->headerCodes[$code]);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(['success'=>false, 'code'=>$code, 'data'=>$data]);
	}

	public function ijson() {
		$json = file_get_contents('php://input');
		if (!isset($json)) return $this->rjsone(400, 'Invalid Input');
		$obj = json_decode($json, true);
		return $obj;
	}
}

?>