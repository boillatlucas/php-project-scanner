<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 16/01/18
 * Time: 12:16
 */

namespace App\Http\Controllers;

use App\Project;
use App\Services\ProjectAnalyzer;
use Illuminate\Http\Request;

class AnalyzerController extends Controller
{
    public function request(Request $request)
    {
        $repository = $request->request->get('repository');
        $email = $request->request->get('email');
        $slug = str_slug(md5($repository).uniqid());

        $project = new Project();
        $project->slug = $slug;
        $project->email = $email;
        $project->repository_url = $repository;
        if($project->save()){
            \Amqp::publish('project_consume', $slug, ['queue' => 'analyze']);
            return response()->json(array('return_code'=>'OK', 'return'=>$project));
        }else{
            return response()->json(array('return_code'=>"FAILED", 'error'=>"Save error."));
        }
    }

    public function analyze()
    {
        ProjectAnalyzer::analyze();
    }
}