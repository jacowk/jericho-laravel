<?php
/* ****************************** Role Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_ROLE], function() {
		/* Search Roles */
		Route::get('/search-role', [
				'uses' => 'RoleController@getSearchRole',
				'as' => 'search-role'
		]);
		
		Route::post('/search-role', [
				'uses' => 'RoleController@getSearchRole',
				'as' => 'search-role'
		]);
		
		/* Pagination */
		Route::get('/do-search-role', [
				'uses' => 'RoleController@postDoSearchRole',
				'as' => 'do-search-role'
		]);
		
		Route::post('/do-search-role', [
				'uses' => 'RoleController@postDoSearchRole',
				'as' => 'do-search-role'
		]);
		
		/* View Role */
		Route::get('/view-role/{role_id}', [
				'uses' => 'RoleController@getViewRole',
				'as' => 'view-role'
		]);
		
		Route::post('/view-role/{role_id}', [
				'uses' => 'RoleController@getViewRole',
				'as' => 'view-role'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_ROLE], function() {
		/* Add an Role */
		Route::post('/add-role', [
				'uses' => 'RoleController@getAddRole',
				'as' => 'add-role'
		]);
		
		Route::get('/add-role', [
				'uses' => 'RoleController@getAddRole',
				'as' => 'add-role'
		]);
		
		Route::post('/do-add-role', [
				'uses' => 'RoleController@postDoAddRole',
				'as' => 'do-add-role'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_ROLE], function() {
		/* Update an Role */
		Route::get('/update-role/{role_id}', [
				'uses' => 'RoleController@getUpdateRole',
				'as' => 'update-role'
		]);
		
		Route::post('/update-role/{role_id}', [
				'uses' => 'RoleController@getUpdateRole',
				'as' => 'update-role'
		]);
		
		Route::post('/do-update-role/{role_id}', [
				'uses' => 'RoleController@postDoUpdateRole',
				'as' => 'do-update-role'
		]);
		
		/* Copy role permissions */
		Route::post('/copy-role-permissions/{role_id}', [
				'uses' => 'RoleController@getCopyRolePermissions',
				'as' => 'copy-role-permissions'
		]);
		
		Route::post('/do-copy-role-permissions/{role_id}', [
				'uses' => 'RoleController@postDoCopyRolePermissions',
				'as' => 'do-copy-role-permissions'
		]);
	});
	
});