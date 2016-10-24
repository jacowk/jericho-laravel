<?php
/* ****************************** Document Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_DOCUMENT], function() {
		/* View Document */
		Route::get('/view-document/{document_id}', [
				'uses' => 'DocumentController@getViewDocument',
				'as' => 'view-document'
		]);
		
		Route::post('/view-document/{document_id}', [
				'uses' => 'DocumentController@getViewDocument',
				'as' => 'view-document'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_DOCUMENT], function() {
		/* Add an Document */
		Route::post('/add-document/{property_flip_id}', [
				'uses' => 'DocumentController@getAddDocument',
				'as' => 'add-document'
		]);
		
		Route::get('/add-document/{property_flip_id}', [
				'uses' => 'DocumentController@getAddDocument',
				'as' => 'add-document'
		]);
		
		Route::post('/do-add-document', [
				'uses' => 'DocumentController@postDoAddDocument',
				'as' => 'do-add-document'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_DOCUMENT], function() {
		/* Update an Document */
		Route::post('/update-document/{document_id}', [
				'uses' => 'DocumentController@getUpdateDocument',
				'as' => 'update-document'
		]);
		
		Route::get('/update-document/{document_id}', [
				'uses' => 'DocumentController@getUpdateDocument',
				'as' => 'update-document'
		]);
		
		Route::post('/do-update-document/{document_id}', [
				'uses' => 'DocumentController@postDoUpdateDocument',
				'as' => 'do-update-document'
		]);
	});
	
	Route::group(['middleware' => 'permission:' . PermissionConstants::DOWNLOAD_DOCUMENT], function() {
		/* Download file */
		Route::get('/download-document/{document_id}', [
				'uses' => 'DocumentController@downloadDocument',
				'as' => 'download-document'
		]);
		
		Route::get('/download-document-direct/{document_id}', [
				'uses' => 'DocumentController@downloadDocumentDirect',
				'as' => 'download-document-direct'
		]);
		
		Route::get('/download-document-database/{document_id}', [
				'uses' => 'DocumentController@downloadDocumentDatabase',
				'as' => 'download-document-database'
		]);
	});

});