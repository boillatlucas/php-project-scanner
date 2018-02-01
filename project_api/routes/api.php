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

Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');

if(env('ACTIVE_AUTH_TOKEN')){
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('get-details', 'API\PassportController@getDetails');

        Route::post('project', 'AnalyzerController@request')->name('project_request');
        Route::get('project', function (){
            return response()->json(array('return_code'=>"FAILED", 'error'=>"Missing slug parameter."));
        });
        Route::get('project/{slug}', 'ProjectController@getLogs')->name('project_get_log');
        Route::get('user-projects/{analyzed?}', 'ProjectController@getProjectsUserConnected')->name('user_get_projects');
        Route::post('logout','API\PassportController@logoutApi');
    });
}else{
    Route::post('project', 'AnalyzerController@request')->name('project_request');
    Route::get('project', function (){
        return response()->json(array('return_code'=>"FAILED", 'error'=>"Missing slug parameter."));
    });
    Route::get('project/{slug}', 'ProjectController@getLogs')->name('project_get_log');
}