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
        $branch = $request->request->get('branch');

        $project = new Project();
        $project->slug = $slug;
        $project->repository_url = $repository;
        $project->branch = (!empty($branch)) ? $branch : 'master';

        $user = \auth('api')->user();
        if ($user) {
            $project->user_id = $user->id;
            $project->email = $user->email;
        }

        if (!empty($email)) {
            $project->email = $email;
        }

        if ($project->save()) {
            \Amqp::publish('project_consume', $slug, ['queue' => 'analyze']);
            $content = [
                'return_code' => 'OK',
                'return' => [
                    'url_project_logs' => route('project_get_log', ['slug' => $project->slug]),
                    'project_saved' => $project
                ]
            ];
        }

        $content = $content ?? ['return_code' => "FAILED", 'error' => "Save error."];

        return response()->json($content);
    }

    public function analyze()
    {
        ProjectAnalyzer::analyze();
    }
}