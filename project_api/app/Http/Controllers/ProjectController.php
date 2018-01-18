<?php

namespace App\Http\Controllers;

use App\LogLine;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
   public function getLogs($slug){
       $logs = LogLine::all()->where('log.project.slug', $slug)->load('log.project', 'log.log_type');
       $logs_return = array('return_code'=>'OK', 'count_result'=>count($logs->toArray()), 'return'=>array());
       if(empty($logs->toArray())){
           return response()->json(array('return_code'=>"OK", 'error'=>"No logs for this project."));
       }
       foreach ($logs as $log) {
           array_push($logs_return['return'], $log);
       }
       return response()->json($logs_return);
   }
}
