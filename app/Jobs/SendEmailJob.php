<?php

namespace App\Jobs;

use App\Mail\NotifyCampus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $emails;
    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emails, $message)
    {
        $this->emails = $emails;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->emails[0])->send(new NotifyCampus($this->message));         
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
       
    }
}
