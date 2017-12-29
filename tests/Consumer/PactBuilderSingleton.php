<?php

namespace Consumer;

use PhpPact\PactBuilder;
use PhpPact\PactConfig;

class PactBuilderSingleton
{
    /** @var PactBuilder */
    protected static $pactBuilder;

    public static function create(string $consumer, string $provider): PactBuilder
    {
        if (!isset(static::$pactBuilder))
        {
            $config = new PactConfig();
            $config->setPactDir(__DIR__);
            $builder = new PactBuilder($config);
            $builder->serviceConsumer($consumer)->hasPactWith($provider);
            static::$pactBuilder = $builder;
        }

        return static::$pactBuilder;
    }
}
