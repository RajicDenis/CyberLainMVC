<?php

// Welcome page
Route::get('/', 'HomeController@index');

/**
  * Define your routes here 
  */ 



/**
 * Set the page to load if the requested URI does not exist
 * Has to be called at the end of the file, after all other routes
 * Path is defined without '.php' extension
 */
Route::setErrorPage('views/error/url');












