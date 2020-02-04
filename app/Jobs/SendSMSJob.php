<?php

namespace App\Jobs;

use App\Http\Controllers\Repository\SMSRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $smsRepo;
    private $phone_numbers;
    private $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SMSRepository $smsRepo, $phone_numbers, $message)
    {
        $this->smsRepo       = $smsRepo;
        $this->phone_numbers = $phone_numbers;
        $this->message       = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->smsRepo->loadConfiguration()
                    ->registerPhoneNumbers($this->phone_numbers)
                    ->buildMessage($this->message)
                    ->send();
    }
}
