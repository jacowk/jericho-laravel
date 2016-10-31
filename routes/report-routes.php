<?php
/* ****************************** Report Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_LEADS_TO_SALES_REPORT], function() {
		Route::get('/leads-to-sales-report', [
				'uses' => 'LeadsToSalesReportController@getLeadsToSalesReport',
				'as' => 'leads-to-sales-report'
		]);
		
		Route::post('/do-leads-to-sales-report', [
				'uses' => 'LeadsToSalesReportController@postDoLeadsToSalesReport',
				'as' => 'do-leads-to-sales-report'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_AMOUNT_OF_LEADS_ACTIONED_REPORT], function() {
		Route::get('/amount-of-leads-actioned-report', [
				'uses' => 'AmountOfLeadsActionedReportController@getAmountOfLeadsActionedReport',
				'as' => 'amount-of-leads-actioned-report'
		]);
		
		Route::post('/do-amount-of-leads-actioned-report', [
				'uses' => 'AmountOfLeadsActionedReportController@postDoAmountOfLeadsActionedReport',
				'as' => 'do-amount-of-leads-actioned-report'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_LEADS_PER_AREA_REPORT], function() {
		Route::get('/leads-per-area-report', [
				'uses' => 'LeadsPerAreaReportController@getLeadsPerAreaReport',
				'as' => 'leads-per-area-report'
		]);
		
		Route::post('/do-leads-per-area-report', [
				'uses' => 'LeadsPerAreaReportController@postDoLeadsPerAreaReport',
				'as' => 'do-leads-per-area-report'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_PROFIT_AND_LOSS_BY_DATE_REPORT], function() {
		Route::get('/profit-and-loss-by-date-report', [
				'uses' => 'ProfitAndLossReportController@getProfitAndLossByDateReport',
				'as' => 'profit-and-loss-by-date-report'
		]);
		
		Route::post('/do-profit-and-loss-by-date-report', [
				'uses' => 'ProfitAndLossReportController@postDoProfitAndLossByDateReport',
				'as' => 'do-profit-and-loss-by-date-report'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_TOTALS_PER_STATUS_REPORT], function() {
		Route::get('/totals-per-status-report', [
				'uses' => 'TotalsPerStatusReportController@getTotalsPerStatusReport',
				'as' => 'totals-per-status-report'
		]);
		
		Route::post('/do-totals-per-status-report', [
				'uses' => 'TotalsPerStatusReportController@postDoTotalsPerStatusReport',
				'as' => 'do-totals-per-status-report'
		]);
	});

});