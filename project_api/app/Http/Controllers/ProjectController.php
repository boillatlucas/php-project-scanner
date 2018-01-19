<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectController extends Controller
{
   public function getLogs($slug){
       $project_logs = Project::with('logs', 'logs.logs_lines', 'logs.log_type')->where('slug', $slug)->first();
       if(empty($project_logs->toArray())){
           return response()->json(array('return_code'=>"FAILED", 'error'=>"No logs for this project."));
       }
       $logs_return = array('return_code'=>'OK', 'count_result'=>count($project_logs->logs), 'return'=>$project_logs);
       return response()->json($logs_return);
   }
}
