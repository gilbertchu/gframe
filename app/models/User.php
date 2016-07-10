<?php

//TODO
class User {
	private $db;
	private $sess;

	public function __construct() {
		$this->db = DB::conn();
	}

	public function create($username, $email, $password) {
		//Check if username is available
		$stmt = $this->db->prepare("SELECT username FROM users WHERE username=?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($existing);
		if ($stmt->fetch()) {
			$stmt->close();
			return ['success'=>false, 'message'=>'Username not available'];
		}

		//Check if email is available
		$stmt = $this->db->prepare("SELECT email FROM users WHERE email=?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($existing);
		if ($stmt->fetch()) {
			$stmt->close();
			return ['success'=>false, 'message'=>'Email not available'];
		}

		//Create hash from password
		$hashed = password_hash($password, PASSWORD_BCRYPT);

		//Store in database
		$stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
		$stmt->bind_param("sss", $username, $email, $password);
		$stmt->execute();
		$stmt->close();

		//Extra steps?
		return ['success'=>true, 'message'=>'Created account', 'username'=>$username];
	}
}

?>