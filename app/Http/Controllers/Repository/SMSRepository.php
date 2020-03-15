<?php

namespace App\Http\Controllers\Repository;


use GuzzleHttp\Client;


class SMSRepository
{
	private $phoneNumbers = [];
	private $apiClient;
	private $messageClient;
	private $messages = [];

	public function loadConfiguration()
	{
		$this->client = new Client();
		return $this;
	}

	public function registerPhoneNumbers(array $phoneNumbers)
	{
		$this->phoneNumbers = $phoneNumbers;
		return $this;
	}

	public function buildMessage(string $message)
	{
		foreach ($this->phoneNumbers as $numbers) {
			$this->messages[] = [
				'phone_number' => $numbers,
                'message' => $message,
                'deviceId' => config('sms.deviceId'),
			];
		}

		return $this;
	}

	public function send()
	{
		$this->messageClient->sendMessages($this->messages);
	}
}
