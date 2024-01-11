<?php

namespace Carmentis\Operator\tests;

use PHPUnit\Framework\TestCase;
use Carmentis\Operator\Operator;

class OperatorTest extends TestCase
{
    private $operator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->operator = new Operator('http://localhost:3005');
    }

    public function testGetVersion()
    {
        $version = $this->operator->getVersion();
        $this->assertEquals('0.0.1', $version, "Version is not 0.0.1");
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->operator);
    }
}

