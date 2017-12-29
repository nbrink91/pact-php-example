<?php

namespace Consumer\Service;

use Consumer\HttpMockHttpClient;
use Consumer\PactBuilderSingleton;
use PhpPact\Mocks\MockHttpService\Models\ProviderServiceRequest;
use PhpPact\Mocks\MockHttpService\Models\ProviderServiceResponse;
use PhpPact\PactBuilder;
use PHPUnit\Framework\TestCase;

class ConsumerServiceHelloTest extends TestCase
{
    /** @var PactBuilder */
    private $pactBuilder;

    protected function setUp()
    {
        $this->pactBuilder = PactBuilderSingleton::create('consumer1', 'provider1');
    }

    public function testGetHelloString()
    {
        $requestHeaders = [
            "Content-Type" => "application/json"
        ];
        $request = new ProviderServiceRequest("GET", "/hello/Nick", $requestHeaders);

        $responseHeaders = [
            "Content-Type" => "application/json;charset=utf-8",
        ];

        $response = new ProviderServiceResponse(200, $responseHeaders);
        $response->setBody(json_encode([
            "message" => "Hello, Nick"
        ]));

        $mockService = $this->pactBuilder->getMockService();
        $mockService
            ->given("Get Hello")
            ->uponReceiving("A get request to /hello/{name}")
            ->with($request)
            ->willRespondWith($response);

        $service = new ConsumerService(new HttpMockHttpClient($mockService->getHost()), 'http://localhost');
        $response = $service->getHelloString('Nick');

        $mockService->verifyInteractions();

        $this->assertEquals('Hello, Nick', $response);
    }
}
