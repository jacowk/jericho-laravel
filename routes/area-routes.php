<?php
/* ****************************** Area Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_AREA], function() {
		
		Route::group(['middleware' => 'breadcrumb:search-area,,Search Area,true'], function() {
			
			/* Search Areas */
			Route::get('/search-area', [
					'uses' => 'AreaController@getSearchArea',
					'as' => 'search-area'
			]);
			
			Route::post('/search-area', [
					'uses' => 'AreaController@getSearchArea',
					'as' => 'search-area'
			]);
			
			/* Pagination */
			Route::get('/do-search-area', [
					'uses' => 'AreaController@postDoSearchArea',
					'as' => 'do-search-area'
			]);
			
			Route::post('/do-search-area', [
					'uses' => 'AreaController@postDoSearchArea',
					'as' => 'do-search-area'
			]);
		});
		
		Route::group(['middleware' => 'breadcrumb:view-area,area_id,View Area,false'], function() {
			/* View Area */
			Route::get('/view-area/{area_id}', [
					'uses' => 'AreaController@getViewArea',
					'as' => 'view-area'
			]);
	
			Route::post('/view-area/{area_id}', [
					'uses' => 'AreaController@getViewArea',
					'as' => 'view-area'
			]);
		});
	});
	
	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_AREA], function() {
		
		Route::group(['middleware' => 'breadcrumb:add-area,,Add Area,false'], function() {
			/* Add an Area */
			Route::post('/add-area', [
					'uses' => 'AreaController@getAddArea',
					'as' => 'add-area'
			]);
			
			Route::get('/add-area', [
					'uses' => 'AreaController@getAddArea',
					'as' => 'add-area'
			]);
		});
	
		Route::post('/do-add-area', [
				'uses' => 'AreaController@postDoAddArea',
				'as' => 'do-add-area'
		]);
	});
	
	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_AREA], function() {
		
		Route::group(['middleware' => 'breadcrumb: update-area,["area_id"=>$area_id],Update Area,false'], function() {
			
			/* Update an Area */
			Route::get('/update-area/{area_id}', [
					'uses' => 'AreaController@getUpdateArea',
					'as' => 'update-area'
			]);
			
			Route::post('/update-area/{area_id}', [
					'uses' => 'AreaController@getUpdateArea',
					'as' => 'update-area'
			]);
		});

		Route::post('/do-update-area/{area_id}', [
				'uses' => 'AreaController@postDoUpdateArea',
				'as' => 'do-update-area'
		]);
	});

});
