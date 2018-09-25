<?php

// Welcome page
Router::get('/', 'UsersController@index');

Router::get('/page', function() {
	require APPROOT . '/views/page.php';
});

Router::get('/about', 'UsersController@about');

Router::post('/about', 'UsersController@create');


/**
 * Set the page to load if the requested URI does not exist
 * Has to be called at the end of the file, after all other routes
 * Path is defined without '.php' extension
 */
Router::setErrorPage('views/error/url');












