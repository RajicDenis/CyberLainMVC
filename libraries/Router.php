<?php

spl_autoload_register(function($className) {

	$file = APPROOT . '/app/controllers/'. $className .'.php';

	if(file_exists($file)) {
		require_once $file;
	}
});


class Router {

	private static $getUri = [];
	private static $postUri = [];

	public static function get($uri, $method) {

		// Check if GET request
		if($_SERVER['REQUEST_METHOD'] == 'GET') {

			self::processRoute($uri, $method, 'GET');

		}

	}

	public static function post($uri, $method) {

		// Check if POST request
		if($_SERVER['REQUEST_METHOD'] == 'POST') {

			self::processRoute($uri, $method, 'POST');

		}

	}

	/**
	 * Send error page if the requested route does not exist
	 * @param $path String
	 */
	public static function setErrorPage($path) {

		if($_SERVER['REQUEST_METHOD'] == 'GET') {
			
			$enteredURI = (isset($_GET['uri'])) ? $_GET['uri'] : null;

			if(!in_array($enteredURI, self::$getUri)) {
				require APPROOT . '/'. $path .'.php';
			}
		}

	}

	private static function processRoute($uri, $method, $requestType) {

		// Push uri to array -- set to '/'' if root
		self::$getUri[] = ($uri == '/') ? '/' : trim($uri, '/');

		// Check for GET request -- set to '/' if not set
		$path = isset($_GET['uri']) ? $_GET['uri'] : '/';

		// Compare requested URI with defined routes
		// If they match, execute method
		foreach(self::$getUri as $key => $value) {
			if(preg_match("#^$path$#", $value)) {
				
				// Check if the $method is an anonymous function or a controller method (passed as string)
				if(gettype($method) == 'string') {

					$con = explode('@', $method);

					$controller = new $con[0];
					$function = $con[1];

					// If POST request, send data to requested method
					if($requestType == 'GET') {
						$controller->$function();
					} else {
						$controller->$function($_POST);
					}

				} else {

					// If the $method is an anonymous function, execute it
					$method();
				}				

				die();
			} 
		}
	}

}