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

// TODO : sécuriser l'accès à l'analyse ?

Route::get('/project/analyze/', [
    'as' => 'project_analyze', 'uses' => 'AnalyzerController@analyze'
]);

Route::get('/', function () {
    return view('welcome');
});