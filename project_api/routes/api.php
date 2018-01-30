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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('get-details', 'API\PassportController@getDetails');

    Route::post('project', 'AnalyzerController@request')->name('project_request');
    Route::get('project', function (){
        return response()->json(array('return_code'=>"FAILED", 'error'=>"Missing slug parameter."));
    });
    Route::get('project/{slug}', 'ProjectController@getLogs')->name('project_get_log');
});