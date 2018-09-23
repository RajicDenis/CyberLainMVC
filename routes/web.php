<?php

// Initialize router
$router = new Router;

// Welcome page
$router->get('/', function() {
	require APPROOT . '/views/welcome.php';
});

$router->get('/users', 'UsersController@index');

$router->get('/about', 'UsersController@about');





