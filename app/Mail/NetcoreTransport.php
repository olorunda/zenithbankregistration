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
    protected function doSend(RawMessage|SentMessage $message): void
    {
        if (!$message instanceof Email) {
            throw new \LogicException('Only Email messages are supported.');
        }

        $from = $message->getFrom()[0];
        $to   = $message->getTo()[0];

        $payload = [
            'personalizations' => [[ 'recipient' => $to->getAddress() ]],
            'from' => [
                'fromEmail' => $from->getAddress(),
                'fromName'  => $from->getName() ?? 'Laravel App',
            ],
            'subject' => $message->getSubject(),
            'content' => [[
                'type'  => 'html',
                'value' => $message->getHtmlBody() ?? $message->getTextBody(),
            ]]
        ];

        $response = $this->client->request('POST', 'https://api.pepipost.com/v2/sendEmail', [
            'headers' => [
                'api_key'      => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ],
            'json' => $payload,
        ]);

        if (intval($response->getStatusCode()) >= 400) {
            throw new TransportException('Netcore API failed: ' . $response->getContent(false));
        }
    }

    public function __toString(): string
    {
        return 'netcore';
    }
}
