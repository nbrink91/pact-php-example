<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use PhpPact\PactVerifier;

$provider = 'provider1';
$consumer = 'consumer1';

$client = new \Windwalker\Http\HttpClient();

$uriOptions = new \PhpPact\PactUriOptions("http://localhost:80" );
$connector = new \PhpPact\PactBrokerConnector($uriOptions);

$verifier = new PactVerifier('http://localhost:8081');
$verifier
    ->providerState("This is an example")
    ->serviceProvider($provider, $client)
    ->honoursPactWith($consumer)
    ->pactUri('../../tests/Consumer/Service/consumer1-provider1.json')
    ->verify();

$connector->verify(true, "http://somefakebuild", $provider, '1.0.0', $consumer, '1.0.0');
