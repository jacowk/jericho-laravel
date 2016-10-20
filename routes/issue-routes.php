<?php
/* ****************************** Issue Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {
	
	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_ISSUE], function() {
		/* Search Issues */
		Route::get('/search-issue', [
				'uses' => 'IssueController@getSearchIssue',
				'as' => 'search-issue'
		]);
		
		Route::post('/search-issue', [
				'uses' => 'IssueController@getSearchIssue',
				'as' => 'search-issue'
		]);
		
		/* Pagination */
		Route::get('/do-search-issue', [
				'uses' => 'IssueController@postDoSearchIssue',
				'as' => 'do-search-issue'
		]);
		
		Route::post('/do-search-issue', [
				'uses' => 'IssueController@postDoSearchIssue',
				'as' => 'do-search-issue'
		]);
		
		/* View Issue */
		Route::get('/view-issue/{issue_id}', [
				'uses' => 'IssueController@getViewIssue',
				'as' => 'view-issue'
		]);
		
		Route::post('/view-issue/{issue_id}', [
				'uses' => 'IssueController@getViewIssue',
				'as' => 'view-issue'
		]);
	});
	
	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_ISSUE], function() {
		/* Add an Issue */
		Route::post('/add-issue', [
				'uses' => 'IssueController@getAddIssue',
				'as' => 'add-issue'
		]);
		
		Route::get('/add-issue', [
				'uses' => 'IssueController@getAddIssue',
				'as' => 'add-issue'
		]);
		
		Route::post('/do-add-issue', [
				'uses' => 'IssueController@postDoAddIssue',
				'as' => 'do-add-issue'
		]);
	});
	
	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_ISSUE], function() {
		/* Update an Issue */
		Route::get('/update-issue/{issue_id}', [
				'uses' => 'IssueController@getUpdateIssue',
				'as' => 'update-issue'
		]);
		
		Route::post('/update-issue/{issue_id}', [
				'uses' => 'IssueController@getUpdateIssue',
				'as' => 'update-issue'
		]);
		
		Route::post('/do-update-issue/{issue_id}', [
				'uses' => 'IssueController@postDoUpdateIssue',
				'as' => 'do-update-issue'
		]);
	});
});
