<?php

class Controller {

	/**
	 * Require and initialize model
	 * @param string $model name of the model
	 */
	public function model($model) {
	
		if(file_exists(APPROOT . '/app/models/'. $model .'.php')) {

			require APPROOT . '/app/models/'. $model .'.php';

			return new $model;

		} else {

			ErrorHandler::sendError('Model not found!!', true);
		}
	}

	/**
	 * Show view with passed in data
	 * @param string $view path to the view
	 * @param string|array|bool $data
	 */
	public function view($view, $data = []) {

		if(file_exists(APPROOT . '/views/' . $view . '.php')) {

			require APPROOT . '/views/' . $view . '.php';

		} else {

			ErrorHandler::sendError('View not found!!', true);

		}
	}
}