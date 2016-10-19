<?php
/* ****************************** Contractor Service Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_ISSUE_COMMENT], function() {
		/* View Contractor Service */
		Route::get('/view-issue-comment/{issue_comment_id}', [
				'uses' => 'IssueCommentController@getViewIssueComment',
				'as' => 'view-issue-comment'
		]);
		
		Route::post('/view-issue-comment/{issue_comment_id}', [
				'uses' => 'IssueCommentController@getViewIssueComment',
				'as' => 'view-issue-comment'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_ISSUE_COMMENT], function() {
		/* Add an Contractor Service */
		Route::post('/add-issue-comment/{issue_id}', [
				'uses' => 'IssueCommentController@getAddIssueComment',
				'as' => 'add-issue-comment'
		]);
		
		Route::get('/add-issue-comment/{issue_id}', [
				'uses' => 'IssueCommentController@getAddIssueComment',
				'as' => 'add-issue-comment'
		]);
		
		Route::post('/do-add-issue-comment', [
				'uses' => 'IssueCommentController@postDoAddIssueComment',
				'as' => 'do-add-issue-comment'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_ISSUE_COMMENT], function() {
		/* Update an Contractor Service */
		Route::get('/update-issue-comment/{issue_comment_id}', [
				'uses' => 'IssueCommentController@getUpdateIssueComment',
				'as' => 'update-issue-comment'
		]);
		
		Route::post('/update-issue-comment/{issue_comment_id}', [
				'uses' => 'IssueCommentController@getUpdateIssueComment',
				'as' => 'update-issue-comment'
		]);
		
		Route::post('/do-update-issue-comment/{issue_comment_id}', [
				'uses' => 'IssueCommentController@postDoUpdateIssueComment',
				'as' => 'do-update-issue-comment'
		]);
	});

});
