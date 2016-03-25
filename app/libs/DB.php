<?php

class DB {
	public $db;
	public $conn;

	function __construct() {
		$this->db = new mysqli(getenv('DATABASE_HOST'),
								getenv('DATABASE_USERNAME'),
								getenv('DATABASE_PASSWORD'),
								getenv('DATABASE_DATABASE'));
		$this->conn = $db->conn;
	}
}

?>