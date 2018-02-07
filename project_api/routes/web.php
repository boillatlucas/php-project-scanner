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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/projects', 'AdminController@projects')->name('projects');
Route::post('/ajax_relaunch_project_analyze', 'AdminController@ajax_relaunch_project_analyze')->name('ajax_relaunch_project_analyze');
Route::get('/ajax_modal_project_logs', 'AdminController@ajax_modal_project_logs')->name('ajax_modal_project_logs');

Route::get('/users', 'AdminController@users')->name('users');
Route::get('/tools', 'AdminController@tools')->name('tools');
