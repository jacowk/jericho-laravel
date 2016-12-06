<?php
/* ****************************** Report Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_PROFIT_AND_LOSS_REPORT], function() {
		Route::get('/profit-and-loss-report', [
				'uses' => 'ProfitAndLossReportController@getProfitAndLossReport',
				'as' => 'profit-and-loss-report'
		]);
		
		Route::post('/do-profit-and-loss-report', [
				'uses' => 'ProfitAndLossReportController@postDoProfitAndLossReport',
				'as' => 'do-profit-and-loss-report'
		]);
		
		Route::post('/download-profit-and-loss-report-pdf', [
				'uses' => 'ProfitAndLossReportController@downloadPDF',
				'as' => 'download-profit-and-loss-report-pdf'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_SUMMARY_OF_TOTALS_REPORT], function() {
		Route::get('/summary-of-totals-report', [
				'uses' => 'SummaryOfTotalsReportController@getSummaryOfTotalsReport',
				'as' => 'summary-of-totals-report'
		]);
		
		Route::post('/do-summary-of-totals-report', [
				'uses' => 'SummaryOfTotalsReportController@postDoSummaryOfTotalsReport',
				'as' => 'do-summary-of-totals-report'
		]);
		
		Route::post('/download-summary-of-totals-report-pdf', [
				'uses' => 'SummaryOfTotalsReportController@downloadPDF',
				'as' => 'download-summary-of-totals-report-pdf'
		]);
	});

});