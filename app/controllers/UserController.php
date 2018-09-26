<?php

class UserController extends Controller {

	public $model;

	/**
	 * Instantiate model
	 */
	public function __construct() {

		$this->model = $this->model('User');

	}

	public function index() {

		$users = $this->model->getAllUsers();

		return $this->view('welcome', ['id', 'Test']);

	}

}