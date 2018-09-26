<?php

// Welcome page
Route::get('/', 'UserController@index');

Route::get('/page', function() {
	require APPROOT . '/views/page.php';
});

Route::get('/about', 'UserController@about');

Route::post('/about', 'UserController@create');


/**
 * Set the page to load if the requested URI does not exist
 * Has to be called at the end of the file, after all other routes
 * Path is defined without '.php' extension
 */
Route::setErrorPage('views/error/url');












