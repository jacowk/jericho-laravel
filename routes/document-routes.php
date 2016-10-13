<?php
/* ****************************** Document Routes ****************************** */

/* Add an Document */
Route::post('/add-document/{property_flip_id}', [
		'uses' => 'DocumentController@getAddDocument',
		'as' => 'add-document'
])->middleware('auth', 'permission:ADD_DOCUMENT');

Route::get('/add-document/{property_flip_id}', [
		'uses' => 'DocumentController@getAddDocument',
		'as' => 'add-document'
])->middleware('auth', 'permission:ADD_DOCUMENT');

Route::post('/do-add-document', [
		'uses' => 'DocumentController@postDoAddDocument',
		'as' => 'do-add-document'
])->middleware('auth', 'permission:ADD_DOCUMENT');

/* Update an Document */
Route::post('/update-document/{document_id}', [
		'uses' => 'DocumentController@getUpdateDocument',
		'as' => 'update-document'
])->middleware('auth', 'permission:UPDATE_DOCUMENT');

Route::get('/update-document/{document_id}', [
		'uses' => 'DocumentController@getUpdateDocument',
		'as' => 'update-document'
])->middleware('auth', 'permission:UPDATE_DOCUMENT');

Route::post('/do-update-document/{document_id}', [
		'uses' => 'DocumentController@postDoUpdateDocument',
		'as' => 'do-update-document'
])->middleware('auth', 'permission:UPDATE_DOCUMENT');

/* View Document */
Route::get('/view-document/{document_id}', [
		'uses' => 'DocumentController@getViewDocument',
		'as' => 'view-document'
])->middleware('auth', 'permission:VIEW_DOCUMENT');

Route::post('/view-document/{document_id}', [
		'uses' => 'DocumentController@getViewDocument',
		'as' => 'view-document'
])->middleware('auth', 'permission:VIEW_DOCUMENT');

/* Download file */
Route::get('/download-document/{document_id}', [
		'uses' => 'DocumentController@downloadDocument',
		'as' => 'download-document'
])->middleware('auth', 'permission:DOWNLOAD_DOCUMENT');

Route::get('/download-document-direct/{document_id}', [
		'uses' => 'DocumentController@downloadDocumentDirect',
		'as' => 'download-document-direct'
])->middleware('auth', 'permission:DOWNLOAD_DOCUMENT');