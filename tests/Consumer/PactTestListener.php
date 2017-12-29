<?php

namespace Consumer;

use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use PHPUnit\Framework\TestSuite;

class PactTestListener implements TestListener
{
    use TestListenerDefaultImplementation;

    public function endTestSuite(TestSuite $suite)
    {
        $builder = PactBuilderSingleton::create('consumer1', 'provider1');
        $builder->build();
    }
}
