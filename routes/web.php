<?php

// Welcome page
Router::get('/', function() {
	require APPROOT . '/views/welcome.php';
});

Router::get('/page', function() {
	require APPROOT . '/views/page.php';
});

Router::get('/about', 'UsersController@about');

Router::post('/about', 'UsersController@create');


/**
 * Set the page to load if the requested URI does not exist
 * Has to be called at the end of the file, after all other routes
 */
Router::setErrorPage('views/error/url');












