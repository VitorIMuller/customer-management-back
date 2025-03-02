<?php
namespace App\Services\Twilio;

use Twilio\Rest\Client;

class CallService
{
    protected $twilio_client;

    protected $to_number;

    public function __construct($to_number)
    {
        $this->twilio_client = new Client(
            config('services.twilio.account_sid'),
            config('services.twilio.auth_token')
        );
        $this->to_number = $to_number;
    }

    public function call()
    {
        $call = $this->twilio_client->calls->create(
            $this->to_number,
            config('services.twilio.phone_number'),
            [
                'url' => 'http://demo.twilio.com/docs/voice.xml',
            ]
        );

        return $call;
    }
}
