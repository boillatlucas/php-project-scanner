<?php

namespace App\Http\Controllers;

use App\Project;
use App\Mail\NotifyStep;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
   public function getLogs($slug){
       $project_logs = Project::with('logs', 'logs.logs_lines', 'logs.log_type')->where('slug', $slug)->first();
       if(empty($project_logs)){
           return response()->json(array('return_code'=>"FAILED", 'error'=>"No logs for this project."));
       }
       return response()->json(array('return_code'=>'OK', 'count_result'=>count($project_logs->logs), 'return'=>$project_logs));
   }

}
