<?php

namespace App\Services;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;
use App\Managers\Twitter\TwitterManager;

class DiscordWebhookService
{
    protected $clientHttp;
    protected $config;

    public function __construct(ClientInterface $clientHttp, array $config)
    {
        $this->clientHttp = $clientHttp;
        $this->config = $config;
    }

    public function sendOnTweetsThread(array $embed) :DiscordWebhookResponse
    {
        $parameters = [
            'username' => $this->config['parameters']['tweets_thread']['bot']['username'], 
            'avatar_url' => $this->config['parameters']['tweets_thread']['bot']['avatar_url'],
            'content' => null,
            'embeds' => [
                $embed
            ],
        ];

        $url = $this->config['parameters']['tweets_thread']['url'];

        return $this->post($url, $parameters);
    }

    protected function post(string $url, array $parameters) :DiscordWebhookResponse
    {
        $response = $this->clientHttp->post($url, [
            'json' => $parameters
        ]);

        return new DiscordWebhookResponse($response);
    }
}
