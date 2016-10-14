<?php
/* ****************************** Bank Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_BANK], function() {
		/* Search Banks */
		Route::get('/search-bank', [
				'uses' => 'BankController@getSearchBank',
				'as' => 'search-bank'
		]);
		
		Route::post('/search-bank', [
				'uses' => 'BankController@getSearchBank',
				'as' => 'search-bank'
		]);
		
		Route::post('/do-search-bank', [
				'uses' => 'BankController@postDoSearchBank',
				'as' => 'do-search-bank'
		]);
		
		/* View Bank */
		Route::get('/view-bank/{bank_id}', [
				'uses' => 'BankController@getViewBank',
				'as' => 'view-bank'
		]);
		
		Route::post('/view-bank/{bank_id}', [
				'uses' => 'BankController@getViewBank',
				'as' => 'view-bank'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_BANK], function() {
		/* Add an Bank */
		Route::post('/add-bank', [
				'uses' => 'BankController@getAddBank',
				'as' => 'add-bank'
		]);
		
		Route::get('/add-bank', [
				'uses' => 'BankController@getAddBank',
				'as' => 'add-bank'
		]);
		
		Route::post('/do-add-bank', [
				'uses' => 'BankController@postDoAddBank',
				'as' => 'do-add-bank'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_BANK], function() {
		/* Update an Bank */
		Route::get('/update-bank/{bank_id}', [
				'uses' => 'BankController@getUpdateBank',
				'as' => 'update-bank'
		]);
		
		Route::post('/update-bank/{bank_id}', [
				'uses' => 'BankController@getUpdateBank',
				'as' => 'update-bank'
		]);
		
		Route::post('/do-update-bank/{bank_id}', [
				'uses' => 'BankController@postDoUpdateBank',
				'as' => 'do-update-bank'
		]);
	});

});
