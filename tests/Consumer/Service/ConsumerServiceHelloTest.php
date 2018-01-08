<?php

namespace Consumer\Service;

use Pact\Consumer\InteractionBuilder;
use Pact\Consumer\MockServerConfig;
use Pact\Consumer\Model\ConsumerRequest;
use Pact\Consumer\Model\ProviderResponse;
use PHPUnit\Framework\TestCase;

class ConsumerServiceHelloTest extends TestCase
{
    public function testGetHelloString()
    {
        $request = new ConsumerRequest();
        $request
            ->setMethod('GET')
            ->setPath('/hello/Nick')
            ->addHeader('Content-Type', 'application/json');

        $response = new ProviderResponse();
        $response
            ->setStatus(200)
            ->addHeader('Content-Type', 'application/json')
            ->setBody([
                'message' => 'Hello, Nick'
            ]);

        $config = new MockServerConfig('localhost', 7200, 'someConsumer', 'someProvider', sys_get_temp_dir());
        $mockService = new InteractionBuilder($config);
        $mockService
            ->given("Get Hello")
            ->uponReceiving("A get request to /hello/{name}")
            ->with($request)
            ->willRespondWith($response);

        $service = new ConsumerService($config->getBaseUri());
        $result = $service->getHelloString('Nick');

        $this->assertEquals('Hello, Nick', $result);
    }
}
