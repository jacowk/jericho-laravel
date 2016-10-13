<?php
/* ****************************** Contractor Service Routes ****************************** */

/* Add an Contractor Service */
Route::post('/add-contractor-service/{contractor_id}', [
		'uses' => 'ContractorServiceController@getAddContractorService',
		'as' => 'add-contractor-service'
]);

Route::get('/add-contractor-service/{contractor_id}', [
		'uses' => 'ContractorServiceController@getAddContractorService',
		'as' => 'add-contractor-service'
]);

Route::post('/do-add-contractor-service', [
		'uses' => 'ContractorServiceController@postDoAddContractorService',
		'as' => 'do-add-contractor-service'
]);

/* Update an Contractor Service */
Route::get('/update-contractor-service/{contractor_service_id}', [
		'uses' => 'ContractorServiceController@getUpdateContractorService',
		'as' => 'update-contractor-service'
]);

Route::post('/do-update-contractor-service/{contractor_service_id}', [
		'uses' => 'ContractorServiceController@postDoUpdateContractorService',
		'as' => 'do-update-contractor-service'
]);

/* View Contractor Service */
Route::get('/view-contractor-service/{contractor_service_id}', [
		'uses' => 'ContractorServiceController@getViewContractorService',
		'as' => 'view-contractor-service'
]);

Route::post('/view-contractor-service/{contractor_service_id}', [
		'uses' => 'ContractorServiceController@getViewContractorService',
		'as' => 'view-contractor-service'
]);