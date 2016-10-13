<?php
include jericho\Permissions\PermissionConstants;

/* ****************************** Account Routes ****************************** */
Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_ACCOUNT], function() {
		/* Search Accounts */
		Route::get('/search-account', [
				'uses' => 'AccountController@getSearchAccount',
				'as' => 'search-account'
		]);
		
		Route::post('/search-account', [
				'uses' => 'AccountController@getSearchAccount',
				'as' => 'search-account'
		]);
		
		Route::post('/do-search-account', [
				'uses' => 'AccountController@postDoSearchAccount',
				'as' => 'do-search-account'
		]);
		
		/* View Account */
		Route::get('/view-account/{account_id}', [
				'uses' => 'AccountController@getViewAccount',
				'as' => 'view-account'
		]);
		
		Route::post('/view-account/{account_id}', [
				'uses' => 'AccountController@getViewAccount',
				'as' => 'view-account'
		]);
	});
	
	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_ACCOUNT], function() {
		/* Add an Account */
		Route::post('/add-account', [
				'uses' => 'AccountController@getAddAccount',
				'as' => 'add-account'
		]);
		
		Route::get('/add-account', [
				'uses' => 'AccountController@getAddAccount',
				'as' => 'add-account'
		]);
		
		Route::post('/do-add-account', [
				'uses' => 'AccountController@postDoAddAccount',
				'as' => 'do-add-account'
		]);
	});
	
	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_ACCOUNT], function() {
		/* Update an Account */
		Route::get('/update-account/{account_id}', [
				'uses' => 'AccountController@getUpdateAccount',
				'as' => 'update-account'
		]);
		
		Route::post('/update-account/{account_id}', [
				'uses' => 'AccountController@getUpdateAccount',
				'as' => 'update-account'
		]);
		
		Route::post('/do-update-account/{account_id}', [
				'uses' => 'AccountController@postDoUpdateAccount',
				'as' => 'do-update-account'
		]);
	});

});
