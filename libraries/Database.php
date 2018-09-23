<?php

class Database {

	private $dbhost = DBHOST;
	private $dbuser = DBUSER;
	private $dbpass = DBPASS;
	private $dbname = DBNAME;

	public $dbh;

	public function __construct() {

		$dsn = 'mysql:host='. $this->dbhost . ';dbname='. $this->dbname .'';

		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

		try {

			$this->dbh = new PDO($dsn, $this->dbuser, $this->dbpass, $options);


		} catch (PDOException $e) {

			echo $e->getMessage();

		}

	}

	public function connect() {

		return $this->dbh;
		
	}

}