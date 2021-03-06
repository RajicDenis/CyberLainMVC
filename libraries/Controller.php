<?php

class Controller {

	/**
	 * Require and initialize model
	 * @param string $model name of the model
	 */
	public function model($model) {
	
		if(file_exists(APPROOT . '/app/models/'. $model .'.php')) {

			require APPROOT . '/app/models/'. $model .'.php';

			// Instantiate model
			return new $model;

		} else {
			// If no model by selected name is found, return error message
			ErrorHandler::sendError('Model not found!!', true);
		}
	}

	/**
	 * Show view with passed in data
	 * @param string $view path to the view
	 * @param string|array|bool $data
	 */
	public function view($view, $data = null) {

		if(file_exists(APPROOT . '/views/' . $view . '.php')) {
			if(empty($data[0]) == false && !empty($data[1])) {

				// Set the variable name used to access the data from the view
				$name = $data[0];
				$$name = $data[1];

				require APPROOT . '/views/' . $view . '.php';

			} elseif(!isset($data)) {

				// If no data is passed to view, just return view
				require APPROOT . '/views/' . $view . '.php';

			} else {
				
				ErrorHandler::sendError("Incorrect data format in view() method, use an array to pass the data", true);
			}

		} else {

			// If no view is found, return error message
			ErrorHandler::sendError('View not found!!', true);
		}
	}
}