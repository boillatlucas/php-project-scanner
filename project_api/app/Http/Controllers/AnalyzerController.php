<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 16/01/18
 * Time: 12:16
 */

namespace App\Http\Controllers;


use App\Services\EnvironmentService;

class AnalyzerController extends Controller
{
    public function analyze(string $slug)
    {
        $a = new EnvironmentService();
        $a->create('test');
        die('toto');
    }
}