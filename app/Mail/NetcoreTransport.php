<?php
namespace App\Mail;

use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mime\RawMessage;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Mailer\Exception\TransportException;

class NetcoreTransport extends AbstractTransport
{
    protected string $apiKey;
    protected HttpClientInterface $client;

    public function __construct(string $apiKey, HttpClientInterface $client)
    {
        $this->apiKey = $apiKey;
        $this->client = $client;
        parent::__construct();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    protected function doSend(SentMessage $message): void
    {
        $email = $message->getOriginalMessage();

        if (!$email instanceof Email) {
            throw new \LogicException('Only Email messages are supported.');
        }

        $from = $email->getFrom()[0] ?? null;
        $to = $email->getTo()[0] ?? null;

        if (!$from || !$to) {
            throw new \RuntimeException("Missing 'From' or 'To' address.");
        }

        $payload = [
            'from' => [
                'email' => $from->getAddress(),
                'name'  => $from->getName() ?? 'Laravel App',
            ],
            'subject' => $email->getSubject(),
            'content' => [[
                'type'  => 'html',
                'value' => $email->getHtmlBody() ?? $email->getTextBody() ?? '',
            ]],
            'personalizations' => [[
                'to' => [[
                    'email' => $to->getAddress(),
                    'name'  => $to->getName() ?? '',
                ]],
            ]],
        ];

        $response = $this->client->request('POST', 'https://emailapi.netcorecloud.net/v5/mail/send', [
            'headers' => [
                'api_key'      => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ],
            'json' => $payload,
        ]);
//dd($payload);
        if ($response->getStatusCode() >= 400) {
            throw new \Symfony\Component\Mailer\Exception\TransportException(
                'Netcore API failed: ' . $response->getContent(false)
            );
        }
    }
    public function __toString(): string
    {
        return 'netcore';
    }
}
