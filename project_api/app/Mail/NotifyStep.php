<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyStep extends Mailable
{
    use Queueable, SerializesModels;

    protected $logs;
    protected $infos_log_project;

    /**
     * Create a new message instance.
     *
     * @param $logs
     * @param $infos_log_project
     */
    public function __construct($logs, $infos_log_project)
    {
        $this->logs = $logs;
        $this->infos_log_project = $infos_log_project;
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
                'logs' => $this->logs,
                'infos_log_project' => $this->infos_log_project,
            ]);
    }
}
