<?php

namespace App\Http\Controllers;

use App\LogLine;
use App\Mail\NotifyStep;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
   public function getLogs($slug){
       $logs = LogLine::all()->where('log.project.slug', $slug)->load('log.project', 'log.log_type');
       $logs_return = array('return_code'=>'OK', 'count_result'=>count($logs->toArray()), 'return'=>array());
       if(empty($logs->toArray())){
           return response()->json(array('return_code'=>"OK", 'error'=>"No logs for this project."));
       }
       $logs_email = array();
       foreach ($logs as $log) {
           array_push($logs_return['return'], $log);
           $logs_email[$log->log->log_type->type][] = $log;
       }
       //dump($logs_email);
       self::_sendEmail(['email' => 'dimitri.sandron@outlook.fr', 'name' => "Dimitri Sandron"], $logs_email, $logs->first()->log);
       return response()->json($logs_return);
   }


    private function _sendEmail($destinataire, $logs, $infos_log_project){
        Mail::to($destinataire['email'], $destinataire['name'])->send(new NotifyStep($logs, $infos_log_project));
    }

}
