<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 19/01/18
 * Time: 09:55
 */

namespace App\Services;


use App\Analyzer\Analyzer;
use App\Analyzer\PHPCodeFixerToolAnalyzer;
use App\Log;
use App\LogLine;
use App\LogType;
use App\Project;

class ProjectAnalyzer
{
    public static function analyze()
    {
        \Amqp::consume('analyze', function ($message, $resolver) {
            $project = Project::where('slug', '=', $message->body)->first();

            if ($project === null) {
                return;
            }

            $classes[] = new PHPCodeFixerToolAnalyzer();
            $analyzer = new Analyzer();

            $analyzer->run(
                $project->slug,
                $project->repository_url,
                $classes
            );

            foreach ($classes as $class) {
                $class->formatOutput();

                $logType = LogType::where('type', '=', $class::getType())->first();

                if ($logType === null) {
                    $logType = new LogType();
                    $logType->type = $class::getType();
                    $logType->save();
                }

                $log = new Log();
                $log->project_id = $project->id;
                $log->title = $class::getName();
                $log->log_type_id = $logType->id;
                $log->status = $class->isSuccess();
                $log->save();

                foreach ($class->getLines() as $line) {
                    $logLine = new LogLine();
                    $logLine->log_id = $log->id;
                    $logLine->content = $line;
                    $logLine->save();
                }
            }

            $project->analyzed = new \DateTime();
            $project->save();


            $resolver->acknowledge($message);
            $resolver->stopWhenProcessed();
        });
    }
}