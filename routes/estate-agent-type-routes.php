<?php
/* ****************************** Estate Agent Type Routes ****************************** */

/* Search Estate Agent Typees */
Route::get('/search-estate-agent-type', [
		'uses' => 'EstateAgentTypeController@getSearchEstateAgentType',
		'as' => 'search-estate-agent-type'
])->middleware('auth', 'permission:VIEW_ESTATE_AGENT_TYPE');

Route::post('/search-estate-agent-type', [
		'uses' => 'EstateAgentTypeController@getSearchEstateAgentType',
		'as' => 'search-estate-agent-type'
])->middleware('auth', 'permission:VIEW_ESTATE_AGENT_TYPE');

Route::post('/do-search-estate-agent-type', [
		'uses' => 'EstateAgentTypeController@postDoSearchEstateAgentType',
		'as' => 'do-search-estate-agent-type'
])->middleware('auth', 'permission:VIEW_ESTATE_AGENT_TYPE');

/* Add an Estate Agent Type */
Route::post('/add-estate-agent-type', [
		'uses' => 'EstateAgentTypeController@getAddEstateAgentType',
		'as' => 'add-estate-agent-type'
])->middleware('auth', 'permission:ADD_ESTATE_AGENT_TYPE');

Route::get('/add-estate-agent-type', [
		'uses' => 'EstateAgentTypeController@getAddEstateAgentType',
		'as' => 'add-estate-agent-type'
])->middleware('auth', 'permission:ADD_ESTATE_AGENT_TYPE');

Route::post('/do-add-estate-agent-type', [
		'uses' => 'EstateAgentTypeController@postDoAddEstateAgentType',
		'as' => 'do-add-estate-agent-type'
])->middleware('auth', 'permission:ADD_ESTATE_AGENT_TYPE');

/* Update an Estate Agent Type */
Route::get('/update-estate-agent-type/{estate_agent_type_id}', [
		'uses' => 'EstateAgentTypeController@getUpdateEstateAgentType',
		'as' => 'update-estate-agent-type'
])->middleware('auth', 'permission:UPDATE_ESTATE_AGENT_TYPE');

Route::post('/update-estate-agent-type/{estate_agent_type_id}', [
		'uses' => 'EstateAgentTypeController@getUpdateEstateAgentType',
		'as' => 'update-estate-agent-type'
])->middleware('auth', 'permission:UPDATE_ESTATE_AGENT_TYPE');

Route::post('/do-update-estate-agent-type/{estate_agent_type_id}', [
		'uses' => 'EstateAgentTypeController@postDoUpdateEstateAgentType',
		'as' => 'do-update-estate-agent-type'
])->middleware('auth', 'permission:UPDATE_ESTATE_AGENT_TYPE');

/* View Estate Agent Type */
Route::get('/view-estate-agent-type/{estate_agent_type_id}', [
		'uses' => 'EstateAgentTypeController@getViewEstateAgentType',
		'as' => 'view-estate-agent-type'
])->middleware('auth', 'permission:VIEW_ESTATE_AGENT_TYPE');

Route::post('/view-estate-agent-type/{estate_agent_type_id}', [
		'uses' => 'EstateAgentTypeController@getViewEstateAgentType',
		'as' => 'view-estate-agent-type'
])->middleware('auth', 'permission:VIEW_ESTATE_AGENT_TYPE');