<?php

class MainController extends Controller {
	protected $view;

	function __construct() {
		$this->view = new View();
		//$client = new GuzzleHttp\Client();
		//$db = new DB();
	}

	public function get_test($param) {
		$this->view->make('test.php', ['param' => $param]);
	}

	public function post_login() {
		//TODO
		//Back: authenticate user post: username, password
		//no server yet so only check password against one hash
		$password = $_POST['pwd'];
		$hash = getenv('ROOT_HASH');
		if (password_verify($password, $hash)) {
			//OK
		}
		//Server: create jwt token with secret
		
		//Forward: return jwt to client

		//Back: send previously acquired jwt
		//Server: check sent jwt, verify and get user info
		//Forward: send response to client
	}
}

?>