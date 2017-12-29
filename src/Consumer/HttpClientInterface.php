<?php

namespace Consumer;

use Psr\Http\Message\ResponseInterface;

interface HttpClientInterface
{
    public function request($method, $uri, array $options = []): ResponseInterface;
}
