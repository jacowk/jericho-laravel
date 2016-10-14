<?php
/* ****************************** Contractor Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_CONTRACTOR], function() {
		/* Search Contractors */
		Route::get('/search-contractor', [
				'uses' => 'ContractorController@getSearchContractor',
				'as' => 'search-contractor'
		]);
		
		Route::post('/search-contractor', [
				'uses' => 'ContractorController@getSearchContractor',
				'as' => 'search-contractor'
		]);
		
		Route::post('/do-search-contractor', [
				'uses' => 'ContractorController@postDoSearchContractor',
				'as' => 'do-search-contractor'
		]);
		
		/* View Contractor */
		Route::get('/view-contractor/{contractor_id}', [
				'uses' => 'ContractorController@getViewContractor',
				'as' => 'view-contractor'
		]);
		
		Route::post('/view-contractor/{contractor_id}', [
				'uses' => 'ContractorController@getViewContractor',
				'as' => 'view-contractor'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_CONTRACTOR], function() {
		/* Add an Contractor */
		Route::post('/add-contractor', [
				'uses' => 'ContractorController@getAddContractor',
				'as' => 'add-contractor'
		]);
		
		Route::get('/add-contractor', [
				'uses' => 'ContractorController@getAddContractor',
				'as' => 'add-contractor'
		]);
		
		Route::post('/do-add-contractor', [
				'uses' => 'ContractorController@postDoAddContractor',
				'as' => 'do-add-contractor'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_CONTRACTOR], function() {
		/* Update an Contractor */
		Route::get('/update-contractor/{contractor_id}', [
				'uses' => 'ContractorController@getUpdateContractor',
				'as' => 'update-contractor'
		]);
		
		Route::post('/update-contractor/{contractor_id}', [
				'uses' => 'ContractorController@getUpdateContractor',
				'as' => 'update-contractor'
		]);
		
		Route::post('/do-update-contractor/{contractor_id}', [
				'uses' => 'ContractorController@postDoUpdateContractor',
				'as' => 'do-update-contractor'
		]);
	});

});
