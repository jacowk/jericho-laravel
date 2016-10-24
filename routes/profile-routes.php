<?php
/* ****************************** Profile Routes ****************************** */

/* View User */
Route::get('/view-profile', [
		'uses' => 'ProfileController@getViewProfile',
		'as' => 'view-profile'
])->middleware('auth');

Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_PROFILE], function() {
	/* Update an User */
	Route::post('/update-profile/{user_id}', [
			'uses' => 'ProfileController@getUpdateProfile',
			'as' => 'update-profile'
	]);
	
	Route::get('/update-profile/{user_id}', [
			'uses' => 'ProfileController@getUpdateProfile',
			'as' => 'update-profile'
	]);

	Route::post('/do-update-profile/{user_id}', [
			'uses' => 'ProfileController@postDoUpdateProfile',
			'as' => 'do-update-profile'
	]);
});