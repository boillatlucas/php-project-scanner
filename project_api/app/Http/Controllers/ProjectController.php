<?php

namespace App\Http\Controllers;

use App\Project;
use App\Mail\NotifyStep;
use Illuminate\Support\Facades\Mail;

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
   
    /**
     * @param $destinataire
     * @param $project_logs
     *
     * Exemple to use this function :
     * self::_sendEmail(['email' => 'dimitri.sandron@outlook.fr', 'name' => "Dimitri Sandron"], $project_logs);
     */
    private function _sendEmail($destinataire, $project_logs){
        Mail::to($destinataire['email'], $destinataire['name'])->send(new NotifyStep($project_logs));
    }

}
