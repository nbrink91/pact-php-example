<?php

namespace Consumer\Service;

use Pact\Consumer\InteractionBuilder;
use Pact\Consumer\MockServerConfig;
use Pact\Consumer\Model\ConsumerRequest;
use Pact\Consumer\Model\ProviderResponse;
use PHPUnit\Framework\TestCase;

class ConsumerServiceGoodbyeTest extends TestCase
{
    public function testGetGoodbyeString()
    {
        $request = new ConsumerRequest();
        $request
            ->setMethod('GET')
            ->setPath('/goodbye/Nick')
            ->addHeader('Content-Type', 'application/json');

        $response = new ProviderResponse();
        $response
            ->setStatus(200)
            ->addHeader('Content-Type', 'application/json')
            ->setBody([
                'message' => 'Goodbye, Nick'
            ]);

        $config = new MockServerConfig('localhost', 7200, 'someConsumer', 'someProvider', sys_get_temp_dir());
        $mockService = new InteractionBuilder($config);
        $mockService
            ->given("Get Goodbye")
            ->uponReceiving("A get request to /goodbye/{name}")
            ->with($request)
            ->willRespondWith($response);

        $service = new ConsumerService($config->getBaseUri());
        $result = $service->getGoodbyeString('Nick');

        $this->assertEquals('Goodbye, Nick', $result);
    }
}
