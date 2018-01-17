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
        $a = new EnvironmentService(true);
        $logs[] = $a->createContainer('mytest'.mt_rand(0, 2000), 'laradock/workspace:2.0-71', [
            'OpenStdin' => true,
        ]);

        $json = \GuzzleHttp\json_decode($logs[0]);

        $logs[] = $a->startContainer($json->Id);

        $logs[] = $cmd = $a->createCommand($json->Id, ['git', 'clone', 'https://github.com/boillatlucas/php-project-scanner.git']);
        $cmd = \GuzzleHttp\json_decode($cmd);
        $logs[] = $a->startCommand($cmd->Id);

        $logs[] = $cmd = $a->createCommand($json->Id, ['composer', 'global','require',  'jakub-onderka/php-parallel-lint']);
        $cmd = \GuzzleHttp\json_decode($cmd);
        $logs[] = $a->startCommand($cmd->Id);

        $logs[] = $cmd = $a->createCommand($json->Id, ['/root/.composer/vendor/bin/parallel-lint', 'php-project-scanner']);
        $cmd = \GuzzleHttp\json_decode($cmd);
        $logs[] = $a->startCommand($cmd->Id);

        $logs[] = $cmd = $a->stopContainer($json->Id);
        $logs[] = $cmd = $a->rmContainer($json->Id);





        dump($a->getDebug());
        die('toto');
    }
}