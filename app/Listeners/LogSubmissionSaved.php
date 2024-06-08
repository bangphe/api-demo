<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSubmissionSaved
{
    public function __construct()
    {
        //
    }

    public function handle(SubmissionSaved $event)
    {
        Log::info('Submission saved:', ['name' => $event->submission->name, 'email' => $event->submission->email]);
    }
}
