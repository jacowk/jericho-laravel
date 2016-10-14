<?php
/* ****************************** Contractor Type Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_CONTRACTOR_TYPE], function() {
		/* Search Contractor Typees */
		Route::get('/search-contractor-type', [
				'uses' => 'ContractorTypeController@getSearchContractorType',
				'as' => 'search-contractor-type'
		]);
		
		Route::post('/search-contractor-type', [
				'uses' => 'ContractorTypeController@getSearchContractorType',
				'as' => 'search-contractor-type'
		]);
		
		Route::post('/do-search-contractor-type', [
				'uses' => 'ContractorTypeController@postDoSearchContractorType',
				'as' => 'do-search-contractor-type'
		]);
		
		/* View Contractor Type */
		Route::get('/view-contractor-type/{contractor_type_id}', [
				'uses' => 'ContractorTypeController@getViewContractorType',
				'as' => 'view-contractor-type'
		]);
		
		Route::post('/view-contractor-type/{contractor_type_id}', [
				'uses' => 'ContractorTypeController@getViewContractorType',
				'as' => 'view-contractor-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_CONTRACTOR_TYPE], function() {
		/* Add an Contractor Type */
		Route::post('/add-contractor-type', [
				'uses' => 'ContractorTypeController@getAddContractorType',
				'as' => 'add-contractor-type'
		]);
		
		Route::get('/add-contractor-type', [
				'uses' => 'ContractorTypeController@getAddContractorType',
				'as' => 'add-contractor-type'
		]);
		
		Route::post('/do-add-contractor-type', [
				'uses' => 'ContractorTypeController@postDoAddContractorType',
				'as' => 'do-add-contractor-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_CONTRACTOR_TYPE], function() {
		/* Update an Contractor Type */
		Route::get('/update-contractor-type/{contractor_type_id}', [
				'uses' => 'ContractorTypeController@getUpdateContractorType',
				'as' => 'update-contractor-type'
		]);
		
		Route::post('/update-contractor-type/{contractor_type_id}', [
				'uses' => 'ContractorTypeController@getUpdateContractorType',
				'as' => 'update-contractor-type'
		]);
		
		Route::post('/do-update-contractor-type/{contractor_type_id}', [
				'uses' => 'ContractorTypeController@postDoUpdateContractorType',
				'as' => 'do-update-contractor-type'
		]);
	});

});
