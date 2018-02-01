<?php

namespace App\Console\Commands;

use App\Services\ProjectAnalyzer;
use Illuminate\Console\Command;

class ProjectAnalyzerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:analyze';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume messages from rabbitmq to analyze projects';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ProjectAnalyzer::analyze();

        return 0;
    }
}
