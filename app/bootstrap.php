<?php

require_once 'config/Config.php';

spl_autoload_register(function($className) {
	$file = 'libraries/'. $className .'.php';

	if(file_exists($file)) {
		require_once $file;
	}
});




