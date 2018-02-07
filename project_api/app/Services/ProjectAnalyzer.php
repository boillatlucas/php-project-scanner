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
use App\Analyzer\PHPCpdToolAnalyzer;
use App\Analyzer\PHPLocToolAnalyzer;
use App\Analyzer\PHPParallelLintToolAnalyzer;
use App\Log;
use App\LogLine;
use App\LogType;
use App\Mail\NotifyStep;
use App\Project;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log as Logger;
use PhpAmqpLib\Connection\AMQPStreamConnection;


class ProjectAnalyzer
{


    public static function analyze()
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest', '/');
        $channel = $connection->channel();
        $channel->queue_declare('analyze', false, true, false, false);
        $channel->basic_qos(null, 1, null);

        $channel->basic_consume('analyze', '', false, false, false, false, function ($message) {
            $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);

            Logger::info('[Execute analyze from '.exec('hostname -i').' '.exec('hostname').'] - '.$message->body);
            $project = Project::where('slug', '=', $message->body)->first();

            if ($project === null) {
                return;
            }

            $classes[] = new PHPCodeFixerToolAnalyzer();
            $classes[] = new PHPParallelLintToolAnalyzer();
            $classes[] = new PHPLocToolAnalyzer();
            $classes[] = new PHPCpdToolAnalyzer();
            $analyzer = new Analyzer();

            $analyzer->run(
                $project->slug,
                $project->repository_url,
                $classes
            );

            $project->updated_at = new \DateTime();
            $project->save();

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
                $log->status = $class->success();
                $log->final_output = $class->finalOutput();
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

            try
            {
                Mail::to($project->email, $project->email)
                    ->cc(env('EMAIL_CONTACT'), env('EMAIL_CONTACT'))
                    ->send(new NotifyStep($project));
            }
            catch (\Exception $e)
            {
                return $e->getMessage();
            }
        });

        while (count($channel->callbacks)) {
            $channel->wait(null, false, 0);
        }
        Logger::info('[End analyze from '.exec('hostname -i').' '.exec('hostname').']');
    }
}