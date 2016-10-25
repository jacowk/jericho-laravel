<?php
/* ****************************** Audit Trail Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_AUDIT_TRAIL], function() {
		/* Search Audit Trails */
		Route::get('/search-audit-trail', [
				'uses' => 'AuditTrailController@getSearchAuditTrail',
				'as' => 'search-audit-trail'
		]);
		
		Route::post('/search-audit-trail', [
				'uses' => 'AuditTrailController@getSearchAuditTrail',
				'as' => 'search-audit-trail'
		]);
		
		/* Pagination */
		Route::get('/do-search-audit-trail', [
				'uses' => 'AuditTrailController@postDoSearchAuditTrail',
				'as' => 'do-search-audit-trail'
		]);
		
		Route::post('/do-search-audit-trail', [
				'uses' => 'AuditTrailController@postDoSearchAuditTrail',
				'as' => 'do-search-audit-trail'
		]);
	});
	
});

