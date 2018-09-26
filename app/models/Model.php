<?php

class Model {

	protected $db;

	private $stmt;
	private $query;
	private $whereValue;

	/**
	 * Connet to database
	 */
	public function __construct() {

		$database = new Database;
		$this->db = $database->connect();

	}

	/**
	 * Ads condition to query, can be chained
	 * @param string $column column name
	 * @param string|int|bool $value
	 */
	public function where($column, $value) {

		$this->query = 'SELECT * FROM '. $this->table . ' WHERE '. $column .' = :value';
		$this->whereValue = $value;

		return $this;

	}

	/**
	 * Ads condition to query, can be chained
	 * @param string $column column name
	 * @param string $order 'desc' or 'asc'
	 */
	public function orderBy($column, $order) {

		if($this->query != null) {

			$this->query = $this->query . ' ORDER BY '. $column .' '. $order .'';

		} else {

			$this->query = 'SELECT * FROM '. $this->table .' ORDER BY '. $column .' '. $order .'';
		}
		
		return $this;

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
			ErrorHandler::sendError($e->getMessage(), true);
		}

	}

	/**
	 * Get specified column or columns from database table
	 * @param string|array $column column names
	 */
	public function pluck($column) {

		try {

			if($this->query != null) {

				$stmt = $this->db->prepare($this->query);
				$stmt->bindValue(':value', $this->whereValue);
				$stmt->execute();

				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

			ErrorHandler::sendError($e->getMessage(), true);
		}

	}

	/**
	 * Return array with data, used after where() method
	 */
	public function get() {

		try {

			$stmt = $this->db->prepare($this->query);
			$stmt->bindValue(':value', $this->whereValue);
			$stmt->execute();

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $result;

		} catch(PDOException $e) {

			ErrorHandler::sendError($e->getMessage(), true);
		}

	}

	/**
	 * Return single array
	 */
	public function first() {

		try {

			$stmt = $this->db->prepare($this->query);
			$stmt->bindValue(':value', $this->whereValue);
			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);

			return $result;

		} catch(PDOException $e) {
			
			ErrorHandler::sendError($e->getMessage(), true);
		}

	}


}



