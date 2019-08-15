<?php
declare(strict_types=1);


namespace Example\Store\Tests;

use PHPUnit\Framework\TestCase;
use Mockery;

class MockeryTestCase extends TestCase
{
    public function tearDown(): void
    {
        parent::tearDown();
        if ($container = Mockery::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }
        Mockery::close();
    }
}
