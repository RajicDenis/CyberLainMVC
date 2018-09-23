<?php

class UsersController extends Controller {

	public $model;

	public function __construct() {

		$this->model = $this->model('User');

	}

	public function index() {

		$users = $this->model->getAllUsers();

		return $this->view('welcome', $users);

	}

	public function about() {

		return $this->view('about', $this->model);

	}

}