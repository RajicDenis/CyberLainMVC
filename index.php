<?php
require_once 'config/Config.php';
require_once 'app/errors/ErrorHandler.php';

/**
 * Initialize ErrorHandler
 * Catch errors and redirect to error view
 */
ini_set('display_errors', 0);
$error = new ErrorHandler();
$error->initialize();

require_once 'app/bootstrap.php';

?>



