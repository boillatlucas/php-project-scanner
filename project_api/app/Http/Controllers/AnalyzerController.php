<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 16/01/18
 * Time: 12:16
 */

namespace App\Http\Controllers;


use App\Analyzer\Analyzer;
use App\Analyzer\PHPCodeFixerToolAnalyzer;
use App\Analyzer\PHPParallelLintToolAnalyzer;

class AnalyzerController extends Controller
{
    /**
     * Main entry for analyses
     *
     *
     * @param string $slug
     */
    public function analyze(string $slug)
    {
        $fixer = new PHPCodeFixerToolAnalyzer();
        $linter = new PHPParallelLintToolAnalyzer();
        $analyzer = new Analyzer();

        $analyzer->run(
            'wooot'.mt_rand(0,1500),
            'https://github.com/boillatlucas/php-project-scanner.git',
            [$fixer, $linter]
        );

        dump($fixer->formatOutput()->getLines());
        dump($linter->formatOutput()->getLines());
        dump($linter->isSuccess());
    }
}