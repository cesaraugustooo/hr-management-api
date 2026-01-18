<?php

namespace App\Jobs;

use App\Services\MailService;
use Error;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct( public string $email )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(MailService $mailService)
    {
        $mailService->sendMail($this->email);
    }
}
