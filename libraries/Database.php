<?php

class Database {

	private $dbhost = DBHOST;
	private $dbuser = DBUSER;
	private $dbpass = DBPASS;
	private $dbname = DBNAME;

	public $dbh;

	/**
	 * Connect to the database
	 */
	public function __construct() {

		$dsn = 'mysql:host='. $this->dbhost . ';dbname='. $this->dbname .'';

		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

		try {

			$this->dbh = new PDO($dsn, $this->dbuser, $this->dbpass, $options);


		} catch (PDOException $e) {

			ErrorHandler::sendError($e->getMessage(), true);

		}

	}

	/**
	 * Return database connection
	 */
	public function connect() {

		return $this->dbh;
		
	}

}