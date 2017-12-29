<?php

namespace Consumer;

use GuzzleHttp\Psr7\Request;
use PhpPact\Mocks\MockHttpService\MockProviderHost;
use Psr\Http\Message\ResponseInterface;

class HttpMockHttpClient implements HttpClientInterface
{
    /** @var MockProviderHost */
    private $mockHost;

    public function __construct(MockProviderHost $mockHost)
    {
        $this->mockHost = $mockHost;
    }

    public function request($method, $uri, array $options = []): ResponseInterface
    {
        $request = new Request($method, $uri, $options);
        return $this->mockHost->handle($request);
    }
}
