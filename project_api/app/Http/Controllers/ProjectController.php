<?php

namespace App\Http\Controllers;

use App\Project;
use App\Mail\NotifyStep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    /**
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLogs($slug){
       $project_logs = Project::with('logs', 'logs.logs_lines', 'logs.log_type')->where('slug', $slug)->first();
       if(empty($project_logs)){
           return response()->json(array('return_code'=>"FAILED", 'error'=>"No logs for this project."));
       }
       return response()->json(array('return_code'=>'OK', 'count_result'=>count($project_logs->logs), 'return'=>$project_logs));
   }

    /**
     * @param null $analyzed
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProjectsUserConnected($analyzed = null){
        if (Auth::check()) {
           $user = Auth::user();
           switch ($analyzed){
               case 'analyzed':
                   $projects = Project::where('user_id', $user->id)->whereNotNull('analyzed')->get();
                   break;
               case 'not-analyzed':
                   $projects = Project::where('user_id', $user->id)->whereNull('analyzed')->get();
                   break;
               case null:
                   $projects = Project::where('user_id', $user->id)->get();
                   break;
               default:
                   return response()->json(array('return_code' => "FAILED", 'error' => "Unknown parameter ('analyzed' or 'not-analyzed')"));
           }
       }else{
            return response()->json(array('return_code' => "FAILED", 'error' => "User doesn't logged."));
        }
       if(empty($projects)){
           return response()->json(array('return_code'=>"FAILED", 'error'=>"No projects for this user."));
       }
       return response()->json(array('return_code'=>'OK', 'count_result'=>count($projects), 'return'=>$projects));
   }

}
