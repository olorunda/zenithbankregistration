<?php

namespace App\Mail;

use Illuminate\Mail\Transport\Transport;
use Swift_Mime_SimpleMessage;
use Illuminate\Support\Facades\Http;

class NetcoreTransport extends Transport
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        $from = array_keys($message->getFrom())[0];
        $to = array_keys($message->getTo())[0];
        $subject = $message->getSubject();
        $html = $message->getBody();

        $payload = [
            'personalizations' => [[
                'recipient' => $to
            ]],
            'from' => [
                'fromEmail' => $from,
                'fromName' => 'Your App'
            ],
            'subject' => $subject,
            'content' => [
                [
                    'type' => 'html',
                    'value' => $html
                ]
            ]
        ];

        $response = Http::withHeaders([
            'api_key' => $this->apiKey,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('https://api.pepipost.com/v2/sendEmail', $payload);

        return $response->successful();
    }
}

