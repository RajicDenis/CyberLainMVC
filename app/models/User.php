<?php

require_once 'Model.php';

class User extends Model {

	protected $table = 'users';
	protected $name;
	protected $email;

	protected $db;

	public function __construct() {

		$database = new Database;
		$this->db = $database->connect();

		return $this->db;

	}

	public function getAllUsers() {

		$user = $this->orderBy('id', 'desc')->get();

		return $user;

	}

	public function addUser($data) {

		$query = 'INSERT INTO users (name, email) VALUES (:name, :email)';

		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':name', $data['name']);
		$stmt->bindValue(':email', $data['email']);

		$stmt->execute();

		return 'User created!';

	}

}