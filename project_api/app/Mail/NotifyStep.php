<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyStep extends Mailable
{
    use Queueable, SerializesModels;

    protected $project_logs;

    /**
     * Create a new message instance.
     *
     * @param $project_logs
     */
    public function __construct($project_logs)
    {
        $this->project_logs = $project_logs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notify_step')
            ->with([
                'project_logs' => $this->project_logs,
                'route_user_projects' => env('APP_URL_FRONT')."/user-projects/analyzed",
                'route_project_get_logs' => env('APP_URL_FRONT')."/project/".$this->project_logs->slug,
            ]);
    }
}
