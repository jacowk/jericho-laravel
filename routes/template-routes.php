<?php

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_ACCOUNT], function() {
		
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_ACCOUNT], function() {
		
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_ACCOUNT], function() {
		
	});

});
