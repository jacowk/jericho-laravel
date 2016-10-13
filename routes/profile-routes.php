<?php
/* ****************************** Profile Routes ****************************** */

/* View User */
Route::get('/view-profile', [
		'uses' => 'ProfileController@getViewProfile',
		'as' => 'view-profile'
])->middleware('auth');