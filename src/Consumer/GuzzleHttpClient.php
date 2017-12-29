<?php

namespace Consumer;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class GuzzleHttpClient implements HttpClientInterface
{
    public function request($method, $uri, array $options = []): ResponseInterface
    {
        $client = new Client();
        return $client->request($method, $uri, $options);
    }
}