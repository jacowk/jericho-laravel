<?php
/* ****************************** Attorney Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {
	
	Route::group(['middleware' => 'permission:VIEW_ATTORNEY'], function() {
		/* Search Attorneys */
		Route::get('/search-attorney', [
				'uses' => 'AttorneyController@getSearchAttorney',
				'as' => 'search-attorney'
		]);
		
		Route::post('/search-attorney', [
				'uses' => 'AttorneyController@getSearchAttorney',
				'as' => 'search-attorney'
		]);
		
		Route::post('/do-search-attorney', [
				'uses' => 'AttorneyController@postDoSearchAttorney',
				'as' => 'do-search-attorney'
		]);
		
		/* View Attorney */
		Route::get('/view-attorney/{attorney_id}', [
				'uses' => 'AttorneyController@getViewAttorney',
				'as' => 'view-attorney'
		]);
		
		Route::post('/view-attorney/{attorney_id}', [
				'uses' => 'AttorneyController@getViewAttorney',
				'as' => 'view-attorney'
		]);
	});
	
	Route::group(['middleware' => 'permission:ADD_ATTORNEY'], function() {
		/* Add an Attorney */
		Route::post('/add-attorney', [
				'uses' => 'AttorneyController@getAddAttorney',
				'as' => 'add-attorney'
		]);
		
		Route::get('/add-attorney', [
				'uses' => 'AttorneyController@getAddAttorney',
				'as' => 'add-attorney'
		]);
		
		Route::post('/do-add-attorney', [
				'uses' => 'AttorneyController@postDoAddAttorney',
				'as' => 'do-add-attorney'
		]);
	});
	
	Route::group(['middleware' => 'permission:UPDATE_ATTORNEY'], function() {
		/* Update an Attorney */
		Route::get('/update-attorney/{attorney_id}', [
				'uses' => 'AttorneyController@getUpdateAttorney',
				'as' => 'update-attorney'
		]);
		
		Route::post('/update-attorney/{attorney_id}', [
				'uses' => 'AttorneyController@getUpdateAttorney',
				'as' => 'update-attorney'
		]);
		
		Route::post('/do-update-attorney/{attorney_id}', [
				'uses' => 'AttorneyController@postDoUpdateAttorney',
				'as' => 'do-update-attorney'
		]);
	});
});
