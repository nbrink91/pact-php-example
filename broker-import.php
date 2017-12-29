<?php

require_once 'vendor/autoload.php';

// create your options
$uriOptions = new \PhpPact\PactUriOptions("http://localhost:80" );
$connector = new \PhpPact\PactBrokerConnector($uriOptions);

// Use the appropriate function to read from a file, JSON string, or ProviderServicePactFile object
$file = __DIR__ . '/tests/Consumer/Service/consumer1-provider1.json';
$statusCode = $connector->publishFile($file, '1.0.0');