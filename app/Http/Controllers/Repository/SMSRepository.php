<?php

namespace App\Http\Controllers\Repository;

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Model\SendMessageRequest;



class SMSRepository
{
	private $phoneNumbers = [];
	private $apiClient;
	private $messageClient;
	private $messages = [];

	public function loadConfiguration()
	{
		// Configure client
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', config('sms.token'));
        $apiClient = new ApiClient($config);
        $this->messageClient = new MessageApi($apiClient);
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
			$this->messages[] = new SendMessageRequest([
				'phoneNumber' => $numbers,
                'message' => $message,
                'deviceId' => config('sms.deviceId'),
			]);
		}

		return $this;
	}

	public function send()
	{
		$this->messageClient->sendMessages($this->messages);
	}
}
