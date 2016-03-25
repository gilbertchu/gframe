<?php

class ApiController extends Controller{
	protected $response;

	function __construct() {
		$this->response = new ApiResponse();
		//$client = new GuzzleHttp\Client();
		//$db = new DB();
	}

	public function get_test() {
		$this->response->rjson(['result'=>"Test successful"]);
	}
}

?>