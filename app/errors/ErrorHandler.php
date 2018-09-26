<?php

class ErrorHandler {

	public static $extraError = null;

	public function initialize() {

		set_error_handler(array($this, 'handleError'));
		register_shutdown_function(array($this, 'fatalShutdown'));

	}
	
	// Handles non-fatal errors
	public function handleError($code, $text, $file, $line) {

		$error = [
			'type' => $code,
			'message' => $text,
			'file' => $file,
			'line' => $line
		];

		$extraError = self::$extraError;

	    require APPROOT .'/views/error/error.php';

	    return true;
	}

	// Handles fatal errors
	public function fatalShutdown() {

	    $error = error_get_last();
	    $extraError = self::$extraError;

	    require APPROOT .'/views/error/error.php';
	}

	public static function sendError($message, $redirect = false) {

		if($redirect == false) {

			self::$extraError = $message;

		} else {

			self::$extraError = $message;

			trigger_error('', E_USER_WARNING);

			die();
		}
		

	}

}