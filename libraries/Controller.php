<?php

class Controller {

	public function model($model) {

		
		if(file_exists(APPROOT . '/app/models/'. $model .'.php')) {

			require APPROOT . '/app/models/'. $model .'.php';

			return new $model;

		} else {

			echo 'Model not found!!';
			
		}

	}

	public function view($view, $data = []) {

		if(file_exists(APPROOT . '/views/' . $view . '.php')) {

			require APPROOT . '/views/' . $view . '.php';

		} else {

			echo 'View dnot found!!';

		}

	}

}