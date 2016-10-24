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

/*
 * User: Jaco Koekemoer (For this comment)
 * Date: 2016-10-24
 * 
 * Alternatively add to composer.json, under autoload as:
 * "jsr-0" {
 * 		"Permission": "/Permission/PermissionConstants.php"
 * }
 *
 * Then on command line run "composer update"
 *
 */
require app_path() . '/Permissions/PermissionConstants.php';

Route::get('/', function () {
    return view('welcome');
}); /* This must not get the 'auth' middleware, otherwise the site redirects to the 'Welcome' page after login, instead of to the 'Home' page. */

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth');

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
include 'diary-item-comment-routes.php';
include 'document-routes.php';
include 'document-type-routes.php';
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
include 'issue-routes.php';
include 'issue-comment-routes.php';
