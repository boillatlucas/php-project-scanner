<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Support\Facades\Auth;

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
       $return_logs = array();
       $return_logs['project'] = $project_logs->toArray();
       unset($return_logs['project']['logs']);
       $return_logs['project']['logs'] = array();
       $i = array();
       foreach ($project_logs->logs as $key => $pl){
           if(empty($i[$pl->status])){ $i[$pl->status] = 0; }
           $iti = $i[$pl->status];
           if(!isset($return_logs['project']['logs'][$pl->status][$iti]['count'])){ $return_logs['project']['logs'][$pl->status][$iti]['count'] = 0; }
           $return_logs['project']['logs'][$pl->status][$iti]['count'] = count($pl->logs_lines->toArray());
           $return_logs['project']['logs'][$pl->status][$iti]['name'] = $pl->title;
           $return_logs['project']['logs'][$pl->status][$iti]['final_output'] = $pl->final_output;
           $return_logs['project']['logs'][$pl->status][$iti]['logs_lines'] = $pl->logs_lines->toArray();
           $i[$pl->status]++;
       }
       return response()->json(array('return_code'=>'OK', 'count_result'=>count($project_logs->logs), 'return'=>$return_logs));
   }

    /**
     * @param null $analyzed
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProjectsUserConnected($analyzed = null)
    {
        if (!Auth::check()) {
            return response()->json(array('return_code' => "FAILED", 'error' => "User doesn't logged."));
        }
        $user = Auth::user();
        switch ($analyzed) {
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
        if (empty($projects)) {
            return response()->json(array('return_code' => "FAILED", 'error' => "No projects for this user."));
        }
        return response()->json(array('return_code' => 'OK', 'count_result' => count($projects), 'return' => $projects));
    }

}
