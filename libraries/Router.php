<?php

spl_autoload_register(function($className) {
	require_once APPROOT . '/app/controllers/' .$className. '.php';
});


class Router {

	private $uri = [];

	public function get($uri, $method) {

		// Push uri to array -- set to '/'' if root
		$this->uri[] = ($uri == '/') ? '/' : trim($uri, '/');

		// Check for GET request -- set to '/' if not set
		$path = isset($_GET['uri']) ? $_GET['uri'] : '/';

		// Compare requested URI with defined routes
		// If they match, execute method
		foreach($this->uri as $key => $value) {
			if(preg_match("#^$path$#", $value)) {
				
				if(gettype($method) == 'string') {

					$con = explode('@', $method);

					$controller = new $con[0];
					$function = $con[1];
					$controller->$function();

				} else {

					$method();
				}				

				die();
			} 
		}

	}

}