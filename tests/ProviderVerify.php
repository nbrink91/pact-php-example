<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Pact\Exception\PactFailureException;
use Pact\PactBrokerConnector;
use Pact\PactUriOptions;
use Pact\PactVerifier;

$provider = 'provider1';
$consumer = 'consumer1';

$client = new \Windwalker\Http\HttpClient();

$uriOptions = new PactUriOptions("http://localhost:80");
$connector = new PactBrokerConnector($uriOptions);

try {
    $verifier = new PactVerifier('http://localhost:8081');
    $verifier
        ->providerState("This is an example")
        ->serviceProvider($provider, $client)
        ->honoursPactWith($consumer)
        ->pactUri(__DIR__ . '/consumer1-provider1.json')
        ->verify();

    $connector->verify(true, "http://somefakebuild", $provider, '1.0.0', $consumer, '1.0.0');
} catch (PactFailureException $e) {
    $connector->verify(false, "http://somefakebuild", $provider, '1.0.0', $consumer, '1.0.0');
    throw $e;
}

echo 'Complete!';