<?php

//TODO
class Auth {
	private $db;
	private $authy;

	public function __construct() {
		$this->db = DB::conn();
		//$this->authy = new Authy\AuthyApi(getenv('AUTHY_API_KEY'));
	}

	public function login($username, $password) {
		//Lookup user password hash in db
		$stmt = $this->db->prepare("SELECT password FROM users WHERE username=?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($hashed);
		if (!$stmt->fetch()) {
			$stmt->close();
			return ['success'=>false, 'message'=>'Invalid username'];
		}

		//Validate credentials
		$success = password_verify($password, $hashed);
		//TODO
	}
}

?>