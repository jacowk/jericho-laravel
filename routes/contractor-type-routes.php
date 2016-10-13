<?php
/* ****************************** Contractor Type Routes ****************************** */

/* Search Contractor Typees */
Route::get('/search-contractor-type', [
		'uses' => 'ContractorTypeController@getSearchContractorType',
		'as' => 'search-contractor-type'
])->middleware('auth', 'permission:VIEW_CONTRACTOR_TYPE');

Route::post('/search-contractor-type', [
		'uses' => 'ContractorTypeController@getSearchContractorType',
		'as' => 'search-contractor-type'
])->middleware('auth', 'permission:VIEW_CONTRACTOR_TYPE');

Route::post('/do-search-contractor-type', [
		'uses' => 'ContractorTypeController@postDoSearchContractorType',
		'as' => 'do-search-contractor-type'
])->middleware('auth', 'permission:VIEW_CONTRACTOR_TYPE');

/* Add an Contractor Type */
Route::post('/add-contractor-type', [
		'uses' => 'ContractorTypeController@getAddContractorType',
		'as' => 'add-contractor-type'
])->middleware('auth', 'permission:ADD_CONTRACTOR_TYPE');

Route::get('/add-contractor-type', [
		'uses' => 'ContractorTypeController@getAddContractorType',
		'as' => 'add-contractor-type'
])->middleware('auth', 'permission:ADD_CONTRACTOR_TYPE');

Route::post('/do-add-contractor-type', [
		'uses' => 'ContractorTypeController@postDoAddContractorType',
		'as' => 'do-add-contractor-type'
])->middleware('auth', 'permission:ADD_CONTRACTOR_TYPE');

/* Update an Contractor Type */
Route::get('/update-contractor-type/{contractor_type_id}', [
		'uses' => 'ContractorTypeController@getUpdateContractorType',
		'as' => 'update-contractor-type'
])->middleware('auth', 'permission:UPDATE_CONTRACTOR_TYPE');

Route::post('/update-contractor-type/{contractor_type_id}', [
		'uses' => 'ContractorTypeController@getUpdateContractorType',
		'as' => 'update-contractor-type'
])->middleware('auth', 'permission:UPDATE_CONTRACTOR_TYPE');

Route::post('/do-update-contractor-type/{contractor_type_id}', [
		'uses' => 'ContractorTypeController@postDoUpdateContractorType',
		'as' => 'do-update-contractor-type'
])->middleware('auth', 'permission:UPDATE_CONTRACTOR_TYPE');

/* View Contractor Type */
Route::get('/view-contractor-type/{contractor_type_id}', [
		'uses' => 'ContractorTypeController@getViewContractorType',
		'as' => 'view-contractor-type'
])->middleware('auth', 'permission:VIEW_CONTRACTOR_TYPE');

Route::post('/view-contractor-type/{contractor_type_id}', [
		'uses' => 'ContractorTypeController@getViewContractorType',
		'as' => 'view-contractor-type'
])->middleware('auth', 'permission:VIEW_CONTRACTOR_TYPE');