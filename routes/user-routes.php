<?php
/* ****************************** User Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_USER], function() {
		/* Search Users */
		Route::get('/search-user', [
				'uses' => 'UserController@getSearchUser',
				'as' => 'search-user'
		]);
		
		Route::post('/search-user', [
				'uses' => 'UserController@getSearchUser',
				'as' => 'search-user'
		]);
		
		/* Pagination */
		Route::get('/do-search-user', [
				'uses' => 'UserController@postDoSearchUser',
				'as' => 'do-search-user'
		]);
		
		Route::post('/do-search-user', [
				'uses' => 'UserController@postDoSearchUser',
				'as' => 'do-search-user'
		]);
		
		/* View User */
		Route::get('/view-user/{user_id}', [
				'uses' => 'UserController@getViewUser',
				'as' => 'view-user'
		]);
		
		Route::post('/view-user/{user_id}', [
				'uses' => 'UserController@getViewUser',
				'as' => 'view-user'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_USER], function() {
		/* Add an User */
		Route::post('/add-user', [
				'uses' => 'UserController@getAddUser',
				'as' => 'add-user'
		]);
		
		Route::get('/add-user', [
				'uses' => 'UserController@getAddUser',
				'as' => 'add-user'
		]);
		
		Route::post('/do-add-user', [
				'uses' => 'UserController@postDoAddUser',
				'as' => 'do-add-user'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_USER], function() {
		/* Update an User */
		Route::get('/update-user/{user_id}', [
				'uses' => 'UserController@getUpdateUser',
				'as' => 'update-user'
		]);
		
		Route::post('/update-user/{user_id}', [
				'uses' => 'UserController@getUpdateUser',
				'as' => 'update-user'
		]);
		
		Route::post('/do-update-user/{user_id}', [
				'uses' => 'UserController@postDoUpdateUser',
				'as' => 'do-update-user'
		]);
	});
	
	Route::group(['middleware' => 'permission:' . PermissionConstants::RESET_PASSWORD], function() {
		/* Update an User */
		Route::get('/reset-password/{user_id}', [
				'uses' => 'UserController@resetPassword',
				'as' => 'reset-password'
		]);
		
		Route::post('/do-reset-password/{user_id}', [
				'uses' => 'UserController@doResetPassword',
				'as' => 'do-reset-password'
		]);
	});

});