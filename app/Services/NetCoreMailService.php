<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NetCoreMailService
{
    protected $apiKey;
    protected $apiUrl;
    protected $fromEmail;
    protected $fromName;

    public function __construct()
    {
        $this->apiKey = env('NETCORE_API_KEY', 'f284df6941cb270d9fe1ff5ebb69fc09');
        $this->apiUrl = env('NETCORE_API_URL', 'https://emailapi.netcorecloud.net/v5/mail/send');
        $this->fromEmail = env('MAIL_FROM_ADDRESS', 'noreply@zenithbank.com');
        $this->fromName = env('MAIL_FROM_NAME', env('APP_NAME', 'Zenith Bank'));
    }

    /**
     * Send an email using NetCore Cloud API
     *
     * @param string $toEmail Recipient email address
     * @param string $toName Recipient name
     * @param string $subject Email subject
     * @param string $htmlContent HTML content of the email
     * @return bool Whether the email was sent successfully
     */
    public function sendEmail(string $toEmail, string $toName, string $subject, string $htmlContent): bool
    {
        try {
            $payload = [
                'from' => [
                    'email' => $this->fromEmail,
                    'name' => $this->fromName
                ],
                'subject' => $subject,
                'content' => [
                    [
                        'type' => 'html',
                        'value' => $htmlContent
                    ]
                ],
                'personalizations' => [
                    [
                        'to' => [
                            [
                                'email' => $toEmail,
                                'name' => $toName
                            ]
                        ]
                    ]
                ]
            ];

            $response = Http::withHeaders([
                'api_key' => $this->apiKey,
                'content-type' => 'application/json',
            ])->post($this->apiUrl, $payload);

            if ($response->successful()) {
                return true;
            } else {
                Log::error('NetCore API Error: ' . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error('NetCore Mail Service Error: ' . $e->getMessage());
            return false;
        }
    }
}