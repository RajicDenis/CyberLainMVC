<?php

class Model {

	protected $db;
	private $stmt;

	/**
	 * Connet to database
	 */
	public function __construct() {

		$database = new Database;
		$this->db = $database->connect();

	}

	/**
	 * Search database by id and return array with results
	 * @param int $id
	 */
	public function find($id) {

		$query = 'SELECT * FROM '. $this->table . ' WHERE id = :id';

		try {

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':id', $id);
			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	}

	/**
	 * Ads condition to query, can be chained
	 * @param string $column column name
	 * @param string|int|bool $value
	 */
	public function where($column, $value) {

		$query = 'SELECT * FROM '. $this->table . ' WHERE '. $column .' = :value';

		try {

			$stmt = $this->db->prepare($query);
			$stmt->bindValue(':value', $value);
			$stmt->execute();

			$this->stmt = $stmt;

			return $this;

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	}

	/**
	 * Get specified column or columns from database table
	 * @param string|array $column column names
	 */
	public function pluck($column) {

		try {

			if($this->stmt != null) {

				$data = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

				$dataArray = [];
				$itemArray = [];

				foreach($data as $item) {

					if(gettype($column) == 'string') {

						$itemArray[$column] = $item[$column];

					} elseif(gettype($column) == 'array') {
						
						foreach($column as $col) {

							$itemArray[$col] = $item[$col];
						}
					}

					array_push($dataArray, $itemArray);
				}

				$result = $dataArray;

			} else {

				if(gettype($column) == 'string') {

					$query = 'SELECT '. $column .' FROM '. $this->table .'';

				} elseif(gettype($column) == 'array') {

					$arrayToString = implode(', ', $column);

					$query = 'SELECT '. $arrayToString .' FROM '. $this->table .'';

				}	

				$stmt = $this->db->prepare($query);
				$stmt->execute();

				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			}			

			return $result;
				

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	}

	/**
	 * Return array with data, used after where() method
	 */
	public function get() {

		try {

			$result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

			return $result;

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	}

	/**
	 * Return single array
	 */
	public function first() {

		try {

			$result = $this->stmt->fetch(PDO::FETCH_ASSOC);

			return $result;

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	}


}



