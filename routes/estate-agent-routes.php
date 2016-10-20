<?php
/* ****************************** Estate Agent Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_ESTATE_AGENT], function() {
		/* Search Estate Agents */
		Route::get('/search-estate-agent', [
				'uses' => 'EstateAgentController@getSearchEstateAgent',
				'as' => 'search-estate-agent'
		]);
		
		Route::post('/search-estate-agent', [
				'uses' => 'EstateAgentController@getSearchEstateAgent',
				'as' => 'search-estate-agent'
		]);
		
		/* Pagination */
		Route::get('/do-search-estate-agent', [
				'uses' => 'EstateAgentController@postDoSearchEstateAgent',
				'as' => 'do-search-estate-agent'
		]);
		
		Route::post('/do-search-estate-agent', [
				'uses' => 'EstateAgentController@postDoSearchEstateAgent',
				'as' => 'do-search-estate-agent'
		]);
		
		/* View Estate Agent */
		Route::get('/view-estate-agent/{estate_agent_id}', [
				'uses' => 'EstateAgentController@getViewEstateAgent',
				'as' => 'view-estate-agent'
		]);
		
		Route::post('/view-estate-agent/{estate_agent_id}', [
				'uses' => 'EstateAgentController@getViewEstateAgent',
				'as' => 'view-estate-agent'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_ESTATE_AGENT], function() {
		/* Add an Estate Agent */
		Route::post('/add-estate-agent', [
				'uses' => 'EstateAgentController@getAddEstateAgent',
				'as' => 'add-estate-agent'
		]);
		
		Route::get('/add-estate-agent', [
				'uses' => 'EstateAgentController@getAddEstateAgent',
				'as' => 'add-estate-agent'
		]);
		
		Route::post('/do-add-estate-agent', [
				'uses' => 'EstateAgentController@postDoAddEstateAgent',
				'as' => 'do-add-estate-agent'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_ESTATE_AGENT], function() {
		/* Update an Estate Agent */
		Route::get('/update-estate-agent/{estate_agent_id}', [
				'uses' => 'EstateAgentController@getUpdateEstateAgent',
				'as' => 'update-estate-agent'
		]);
		
		Route::post('/update-estate-agent/{estate_agent_id}', [
				'uses' => 'EstateAgentController@getUpdateEstateAgent',
				'as' => 'update-estate-agent'
		]);
		
		Route::post('/do-update-estate-agent/{estate_agent_id}', [
				'uses' => 'EstateAgentController@postDoUpdateEstateAgent',
				'as' => 'do-update-estate-agent'
		]);
	});

});
