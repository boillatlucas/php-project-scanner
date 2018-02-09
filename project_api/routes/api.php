<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('login', function (){
    return view('errors.404');
})->name('login');
Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');

Route::post('contact', 'ContactController@sendMail')->name('contact_send_mail');
Route::post('project', 'AnalyzerController@request')->name('project_request');
Route::get('project', function (){
    return response()->json(array('return_code'=>"FAILED", 'error'=>"Missing slug parameter."));
});
Route::get('project/{slug}', 'ProjectController@getLogs')->name('project_get_log');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('get-details', 'API\PassportController@getDetails');

    Route::get('user-projects/{analyzed?}', 'ProjectController@getProjectsUserConnected')->name('user_get_projects');
    Route::post('logout','API\PassportController@logoutApi');
});
