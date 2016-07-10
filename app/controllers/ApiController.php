<?php

class ApiController extends Controller{
	protected $response;

	function __construct() {
		$this->response = new ApiResponse();
		//$client = new GuzzleHttp\Client();
		//$db = new DB();
	}

	public function get_test() {
		return $this->response->rjson(['result'=>"Test successful"]);
	}

	public function post_twilio() {
		$sid = getenv('TWILIO_SID');
		$token = getenv('TWILIO_TOKEN');

		$client = new Services_Twilio($sid, $token);

		$message = $client->account->messages->sendMessage(
			getenv('TWILIO_PHONE'),
			getenv('TWILIO_FORWARD'),
			'Request body: '.$_REQUEST['Body']
		);

		header("content-type: text/xml");
		echo '<?xml version="1.0" encoding="UTF-8"?><Response></Response>';
		return true;
	}
}

?>