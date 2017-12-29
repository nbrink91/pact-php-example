<?php

namespace Consumer\Service;

use Consumer\HttpClientInterface;

class ConsumerService
{
    /** @var HttpClientInterface */
    private $httpClient;

    /** @var string */
    private $url;

    public function __construct(HttpClientInterface $httpClient, string $url)
    {
        $this->httpClient = $httpClient;
        $this->url = $url;
    }

    public function getHelloString(string $name): string
    {
        $response = $this->httpClient->request('GET', "{$this->url}/hello/{$name}", ["Content-Type" => "application/json"]);
        $body = $response->getBody();
        $object = json_decode($body);
        return $object->message;
    }

    public function getGoodbyeString(string $name): string
    {
        $response = $this->httpClient->request('GET', "{$this->url}/goodbye/{$name}", ["Content-Type" => "application/json"]);
        $body = $response->getBody();
        $object = json_decode($body);
        return $object->message;
    }
}
