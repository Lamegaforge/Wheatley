<?php

namespace App\Services;

use GuzzleHttp\Psr7\Response;

class DiscordWebhookResponse
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function itsGood() :bool
    {
        return $this->response->getStatusCode() === 204;
    }
}
