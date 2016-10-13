<?php
/* ****************************** Contractor Routes ****************************** */

/* Search Contractors */
Route::get('/search-contractor', [
		'uses' => 'ContractorController@getSearchContractor',
		'as' => 'search-contractor'
])->middleware('auth', 'permission:VIEW_CONTRACTOR');

Route::post('/search-contractor', [
		'uses' => 'ContractorController@getSearchContractor',
		'as' => 'search-contractor'
])->middleware('auth', 'permission:VIEW_CONTRACTOR');

Route::post('/do-search-contractor', [
		'uses' => 'ContractorController@postDoSearchContractor',
		'as' => 'do-search-contractor'
])->middleware('auth', 'permission:VIEW_CONTRACTOR');

/* Add an Contractor */
Route::post('/add-contractor', [
		'uses' => 'ContractorController@getAddContractor',
		'as' => 'add-contractor'
])->middleware('auth', 'permission:ADD_CONTRACTOR');

Route::get('/add-contractor', [
		'uses' => 'ContractorController@getAddContractor',
		'as' => 'add-contractor'
])->middleware('auth', 'permission:ADD_CONTRACTOR');

Route::post('/do-add-contractor', [
		'uses' => 'ContractorController@postDoAddContractor',
		'as' => 'do-add-contractor'
])->middleware('auth', 'permission:ADD_CONTRACTOR');

/* Update an Contractor */
Route::get('/update-contractor/{contractor_id}', [
		'uses' => 'ContractorController@getUpdateContractor',
		'as' => 'update-contractor'
])->middleware('auth', 'permission:UPDATE_CONTRACTOR');

Route::post('/update-contractor/{contractor_id}', [
		'uses' => 'ContractorController@getUpdateContractor',
		'as' => 'update-contractor'
])->middleware('auth', 'permission:UPDATE_CONTRACTOR');

Route::post('/do-update-contractor/{contractor_id}', [
		'uses' => 'ContractorController@postDoUpdateContractor',
		'as' => 'do-update-contractor'
])->middleware('auth', 'permission:UPDATE_CONTRACTOR');

/* View Contractor */
Route::get('/view-contractor/{contractor_id}', [
		'uses' => 'ContractorController@getViewContractor',
		'as' => 'view-contractor'
])->middleware('auth', 'permission:VIEW_CONTRACTOR');

Route::post('/view-contractor/{contractor_id}', [
		'uses' => 'ContractorController@getViewContractor',
		'as' => 'view-contractor'
])->middleware('auth', 'permission:VIEW_CONTRACTOR');