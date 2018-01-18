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

Route::get('/testScan/', function () {
    $outil = new \App\Analyzer\PhpParallelLintToolAnalyzer();
    $command = $outil->getCommand();
    $command_base = array_keys($command)[0];
    dump($command);
    dump($command[$command_base]);
    $exec = exec($command_base[0] . " " . $command[$command_base][0], $output, $return_val);
    dump($command_base . " " . $command[$command_base][0]);
    dump($output);
    dump($return_val);
    dump($exec);
});

Route::get('/project/', function (){
    return response()->json(array('return_code'=>"FAILED", 'error'=>"Missing slug parameter."));
});
Route::get('/project/{slug}', 'ProjectController@getLogs')->name('project_get_log');