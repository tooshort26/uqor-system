<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\Client;
use Carbon\Carbon;

class PublishNewForm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $data;
    private $client;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $client = new Client();
            $formData = $this->data;
            $formData['days_left']  = Carbon::parse($formData['deadline'])->diffForHumans();
            $formData['status']     = Carbon::parse($formData['deadline'])->isPast();
            $formData['created_at'] = Carbon::parse($formData['created_at'])->format('F j, Y H:m A');
            $formData['deadline']   = Carbon::parse($formData['deadline'])->format('F j, Y H:m A');

            $client->request('POST', 'https://university-quarter-socket.herokuapp.com/upload/form/', [
               'form_params' => $formData
         ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
    }
}
