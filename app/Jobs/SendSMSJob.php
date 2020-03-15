<?php

namespace App\Jobs;

use App\Http\Controllers\Repository\SMSRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Exception;
use GuzzleHttp\Client;

class SendSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $phone_numbers;
    private $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phone_numbers, $message)
    {
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
        $client        = new Client();
        foreach ($this->phone_numbers as $phone_number) {
            $data = [
                'device_id'    => config('sms.deviceId'),
                'message'      => $this->message,
                'phone_number' => $phone_number
            ];

            $client->request('POST', 'https://sdgateway.herokuapp.com/api/device/send/message', ['form_params' => $data]);
        }
        /*try {
            $this->smsRepo->loadConfiguration()
                    ->registerPhoneNumbers($this->phone_numbers)
                    ->buildMessage($this->message)
                    ->send();
        } catch (Exception $e) {
            dd($e->getMessage());
        }*/
    }
}
