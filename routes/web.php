<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

/* ****************************** Included Route Files ****************************** */
include 'test-routes.php';
include 'account-routes.php';
include 'area-routes.php';
include 'attorney-type-routes.php';
include 'attorney-routes.php';
include 'audit-trail-routes.php';
include 'bank-routes.php';
include 'contractor-routes.php';
include 'contractor-service-routes.php';
include 'contractor-type-routes.php';
include 'contact-routes.php';
include 'diary-routes.php';
include 'document-routes.php';
include 'estate-agent-routes.php';
include 'estate-agent-type-routes.php';
include 'followup-routes.php';
include 'greater-area-routes.php';
include 'marital-status-routes.php';
include 'milestone-routes.php';
include 'milestone-type-routes.php';
include 'note-routes.php';
include 'property-flip-routes.php';
include 'property-routes.php';
include 'property-type-routes.php';
include 'suburb-routes.php';
include 'title-routes.php';
include 'transaction-routes.php';
include 'transaction-type-routes.php';
include 'permission-routes.php';
include 'profile-routes.php';
include 'role-routes.php';
include 'user-routes.php';
