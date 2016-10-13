<?php
/* ****************************** Estate Agent Routes ****************************** */

/* Search Estate Agents */
Route::get('/search-estate-agent', [
		'uses' => 'EstateAgentController@getSearchEstateAgent',
		'as' => 'search-estate-agent'
])->middleware('auth', 'permission:VIEW_ESTATE_AGENT');

Route::post('/search-estate-agent', [
		'uses' => 'EstateAgentController@getSearchEstateAgent',
		'as' => 'search-estate-agent'
])->middleware('auth', 'permission:VIEW_ESTATE_AGENT');

Route::post('/do-search-estate-agent', [
		'uses' => 'EstateAgentController@postDoSearchEstateAgent',
		'as' => 'do-search-estate-agent'
])->middleware('auth', 'permission:VIEW_ESTATE_AGENT');

/* Add an Estate Agent */
Route::post('/add-estate-agent', [
		'uses' => 'EstateAgentController@getAddEstateAgent',
		'as' => 'add-estate-agent'
])->middleware('auth', 'permission:ADD_ESTATE_AGENT');

Route::get('/add-estate-agent', [
		'uses' => 'EstateAgentController@getAddEstateAgent',
		'as' => 'add-estate-agent'
])->middleware('auth', 'permission:ADD_ESTATE_AGENT');

Route::post('/do-add-estate-agent', [
		'uses' => 'EstateAgentController@postDoAddEstateAgent',
		'as' => 'do-add-estate-agent'
])->middleware('auth', 'permission:ADD_ESTATE_AGENT');

/* Update an Estate Agent */
Route::get('/update-estate-agent/{estate_agent_id}', [
		'uses' => 'EstateAgentController@getUpdateEstateAgent',
		'as' => 'update-estate-agent'
])->middleware('auth', 'permission:UPDATE_ESTATE_AGENT');

Route::post('/update-estate-agent/{estate_agent_id}', [
		'uses' => 'EstateAgentController@getUpdateEstateAgent',
		'as' => 'update-estate-agent'
])->middleware('auth', 'permission:UPDATE_ESTATE_AGENT');

Route::post('/do-update-estate-agent/{estate_agent_id}', [
		'uses' => 'EstateAgentController@postDoUpdateEstateAgent',
		'as' => 'do-update-estate-agent'
])->middleware('auth', 'permission:UPDATE_ESTATE_AGENT');

/* View Estate Agent */
Route::get('/view-estate-agent/{estate_agent_id}', [
		'uses' => 'EstateAgentController@getViewEstateAgent',
		'as' => 'view-estate-agent'
])->middleware('auth', 'permission:VIEW_ESTATE_AGENT');

Route::post('/view-estate-agent/{estate_agent_id}', [
		'uses' => 'EstateAgentController@getViewEstateAgent',
		'as' => 'view-estate-agent'
])->middleware('auth', 'permission:VIEW_ESTATE_AGENT');