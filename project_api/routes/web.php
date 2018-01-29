<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/project/analyze/', [
    'as' => 'project_analyze', 'uses' => 'AnalyzerController@analyze'
]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/project/', function (){
    return response()->json(array('return_code'=>"FAILED", 'error'=>"Missing slug parameter."));
});

Route::get('/project/{slug}', 'ProjectController@getLogs')->name('project_get_log');

Route::post('/project', 'AnalyzerController@request')->name('project_request');

