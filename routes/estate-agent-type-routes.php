<?php
/* ****************************** Estate Agent Type Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_ESTATE_AGENT_TYPE], function() {
		/* Search Estate Agent Typees */
		Route::get('/search-estate-agent-type', [
				'uses' => 'EstateAgentTypeController@getSearchEstateAgentType',
				'as' => 'search-estate-agent-type'
		]);
		
		Route::post('/search-estate-agent-type', [
				'uses' => 'EstateAgentTypeController@getSearchEstateAgentType',
				'as' => 'search-estate-agent-type'
		]);
		
		Route::post('/do-search-estate-agent-type', [
				'uses' => 'EstateAgentTypeController@postDoSearchEstateAgentType',
				'as' => 'do-search-estate-agent-type'
		]);
		
		/* View Estate Agent Type */
		Route::get('/view-estate-agent-type/{estate_agent_type_id}', [
				'uses' => 'EstateAgentTypeController@getViewEstateAgentType',
				'as' => 'view-estate-agent-type'
		]);
		
		Route::post('/view-estate-agent-type/{estate_agent_type_id}', [
				'uses' => 'EstateAgentTypeController@getViewEstateAgentType',
				'as' => 'view-estate-agent-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_ESTATE_AGENT_TYPE], function() {
		/* Add an Estate Agent Type */
		Route::post('/add-estate-agent-type', [
				'uses' => 'EstateAgentTypeController@getAddEstateAgentType',
				'as' => 'add-estate-agent-type'
		]);
		
		Route::get('/add-estate-agent-type', [
				'uses' => 'EstateAgentTypeController@getAddEstateAgentType',
				'as' => 'add-estate-agent-type'
		]);
		
		Route::post('/do-add-estate-agent-type', [
				'uses' => 'EstateAgentTypeController@postDoAddEstateAgentType',
				'as' => 'do-add-estate-agent-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_ESTATE_AGENT_TYPE], function() {
		/* Update an Estate Agent Type */
		Route::get('/update-estate-agent-type/{estate_agent_type_id}', [
				'uses' => 'EstateAgentTypeController@getUpdateEstateAgentType',
				'as' => 'update-estate-agent-type'
		]);
		
		Route::post('/update-estate-agent-type/{estate_agent_type_id}', [
				'uses' => 'EstateAgentTypeController@getUpdateEstateAgentType',
				'as' => 'update-estate-agent-type'
		]);
		
		Route::post('/do-update-estate-agent-type/{estate_agent_type_id}', [
				'uses' => 'EstateAgentTypeController@postDoUpdateEstateAgentType',
				'as' => 'do-update-estate-agent-type'
		]);
	});

});







