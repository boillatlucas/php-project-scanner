<?php

namespace App\Http\Controllers;

use App\Project;
use App\Services\ProjectAnalyzer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Analyzer\PHPCodeFixerToolAnalyzer;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->user()->authorizeRoles(['admin'])) {
            $request->session()->flash('flash_error', 'Those are not correct credentials!');
            Auth::logout();
            return view('auth.login');
        }
        return view('admin.dashboard');
    }

    public function projects(Request $request)
    {
        if (!$request->user()->authorizeRoles(['admin'])) {
            $request->session()->flash('flash_error', 'Those are not correct credentials!');
            Auth::logout();
            return view('auth.login');
        }
        $projects = Project::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.projects')
            ->with(['projects' => $projects]);
    }

    public function ajax_relaunch_project_analyze(Request $request)
    {
        $slug = $request->slug;
        \Amqp::publish('project_consume', $slug, ['queue' => 'analyze']);
        return response()->json(array('rc' => "0", 'return' => "Project added to queue for reanalyze."));
    }

    public function ajax_modal_project_logs()
    {
        $logs = array();
        if (is_file("../storage/logs/laravel.log")) {
            $logs_file = file_get_contents("../storage/logs/laravel.log");
            if ($logs_file) {
                array_push($logs, "</p>");
                date_default_timezone_set('UTC');
                foreach (explode(PHP_EOL, $logs_file) as $log_line) {
                    if (preg_match('/\[([' . date("Y") . '\-' . date("m") . '\-' . date("d") . ']+\s+' . date("H") . ':[\d\:\d]+)\] local\.+[INFO|ERROR]+:/', $log_line)) {
                        array_push($logs, $log_line);
                        array_push($logs, "<br>");
                    }
                }
                array_push($logs, "<p>");
            }
        }
        return view('admin.modals.projects_logs')
            ->with(['logs' => array_reverse($logs)]);
    }

    public function users(Request $request)
    {
        if (!$request->user()->authorizeRoles(['admin'])) {
            $request->session()->flash('flash_error', 'Those are not correct credentials!');
            Auth::logout();
            return view('auth.login');
        }
        $users = User::with('roles')->get();
        return view('admin.users')
            ->with(['users' => $users]);
    }

    public function tools(Request $request)
    {
        if (!$request->user()->authorizeRoles(['admin'])) {
            $request->session()->flash('flash_error', 'Those are not correct credentials!');
            Auth::logout();
            return view('auth.login');
        }

        $exec_tools = shell_exec('cd ../app/Analyzer/ && ls | grep ToolAnalyzer.php');
        $tools = array();
        foreach (explode(PHP_EOL, $exec_tools) as $key => $t) {
            if ($t != "") {
                $class_name = "App\Analyzer\\" . str_replace(".php", "", $t);
                $class = new $class_name();
                $tools[$key]['name'] = $class->getName();
                $tools[$key]['type'] = $class->getType();
                $tools[$key]['description'] = $class->getDescription();
                $tools[$key]['command_exec'] = $class->getCommand();
                $tools[$key]['file'] = $t;
            }
        }
        return view('admin.tools')
            ->with(['tools' => $tools]);
    }
}
