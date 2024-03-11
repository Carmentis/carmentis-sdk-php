<?php

namespace Carmentis\Operator\tests;

use Carmentis\Operator\Arguments\Authentication;
use Carmentis\Operator\Arguments\Redirect;
use Carmentis\Operator\Exceptions\OperatorException;
use Carmentis\Operator\Exceptions\OperatorRequestException;
use Carmentis\Operator\Exceptions\OperatorResponseException;
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

    /**
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function testGetVersion()
    {
        $version = $this->operator->getOperatorVersion();
        $this->assertEquals('0.0.3', $version->getData(), "Version is not 0.0.3");
    }

    /**
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function testPrepareUserApproval()
    {
        $operatorResponse = $this->operator->prepareUserApproval(
            'test.test',
            new Authentication('email', 'test@test.com'),
            'signMessage',
            [
                'message' => 'test message'
            ],
            new Redirect('https://anyway.bye', 'https://anyway.bye'),
        );

        $this->assertObjectHasProperty('url', $operatorResponse->getData(), "Response does not contain url");
        $this->assertObjectHasProperty('merkleHash', $operatorResponse->getData(), "Response does not contain merkleHash");
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->operator);
    }
}

