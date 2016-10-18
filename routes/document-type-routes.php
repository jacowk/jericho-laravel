<?php
/* ****************************** Document Type Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_DOCUMENT_TYPE], function() {
		/* Search Document Typees */
		Route::get('/search-document-type', [
				'uses' => 'DocumentTypeController@getSearchDocumentType',
				'as' => 'search-document-type'
		]);
		
		Route::post('/search-document-type', [
				'uses' => 'DocumentTypeController@getSearchDocumentType',
				'as' => 'search-document-type'
		]);
		
		Route::post('/do-search-document-type', [
				'uses' => 'DocumentTypeController@postDoSearchDocumentType',
				'as' => 'do-search-document-type'
		]);
		
		/* View Document Type */
		Route::get('/view-document-type/{document_type_id}', [
				'uses' => 'DocumentTypeController@getViewDocumentType',
				'as' => 'view-document-type'
		]);
		
		Route::post('/view-document-type/{document_type_id}', [
				'uses' => 'DocumentTypeController@getViewDocumentType',
				'as' => 'view-document-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_DOCUMENT_TYPE], function() {
		/* Add an Document Type */
		Route::post('/add-document-type', [
				'uses' => 'DocumentTypeController@getAddDocumentType',
				'as' => 'add-document-type'
		]);
		
		Route::get('/add-document-type', [
				'uses' => 'DocumentTypeController@getAddDocumentType',
				'as' => 'add-document-type'
		]);
		
		Route::post('/do-add-document-type', [
				'uses' => 'DocumentTypeController@postDoAddDocumentType',
				'as' => 'do-add-document-type'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_DOCUMENT_TYPE], function() {
		/* Update an Document Type */
		Route::get('/update-document-type/{document_type_id}', [
				'uses' => 'DocumentTypeController@getUpdateDocumentType',
				'as' => 'update-document-type'
		]);
		
		Route::post('/update-document-type/{document_type_id}', [
				'uses' => 'DocumentTypeController@getUpdateDocumentType',
				'as' => 'update-document-type'
		]);
		
		Route::post('/do-update-document-type/{document_type_id}', [
				'uses' => 'DocumentTypeController@postDoUpdateDocumentType',
				'as' => 'do-update-document-type'
		]);
	});

});
