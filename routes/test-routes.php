<?php
/* ****************************** Test Routes ****************************** */

Route::get('/test', [
		'uses' => 'TestController@getTest',
		'as' => 'test'
]);

Route::post('/test', [
		'uses' => 'TestController@postTest',
		'as' => 'test'
]);