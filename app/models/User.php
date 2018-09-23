<?php

class User {

	public $name;
	public $email;


	public $conn;

	public function __construct() {

		$db = new Database;
		$this->conn = $db->connect();

		return $this->conn;

	}

	public function getAllUsers() {

		$query = 'SELECT * FROM users';

		$stmt = $this->conn->prepare($query);

		$stmt->execute();

		$data = [];

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

			extract($row);

			$item_array = [
				'name' => $name,
				'email' => $email
			];

			array_push($data, $item_array);

		}

		return $data;
	}

}