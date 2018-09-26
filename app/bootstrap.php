<?php

spl_autoload_register(function($className) {
	$file = 'libraries/'. $className .'.php';

	if(file_exists($file)) {
		require_once $file;
	}
});

require_once 'app/models/Model.php';
require_once 'routes/web.php';




