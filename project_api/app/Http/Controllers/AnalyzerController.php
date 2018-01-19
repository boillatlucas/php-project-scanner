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
use App\Analyzer\PHPCpdToolAnalyzer;
use App\Analyzer\PHPLocToolAnalyzer;
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
        $stats = new PHPLocToolAnalyzer();
        $cpd = new PHPCpdToolAnalyzer();
        $analyzer = new Analyzer();

        $analyzer->run(
            'wooot'.mt_rand(0,1500),
            'https://github.com/boillatlucas/php-project-scanner.git',
            [$fixer, $linter, $stats, $cpd]
        );

        dump($fixer->formatOutput()->getLines());
        dump($fixer->isSuccess());
        dump($linter->formatOutput()->getLines());
        dump($linter->isSuccess());
        dump($stats->formatOutput()->getLines());
        dump($stats->isSuccess());
        dump($cpd->formatOutput()->getLines());
        dump($cpd->isSuccess());
    }
}