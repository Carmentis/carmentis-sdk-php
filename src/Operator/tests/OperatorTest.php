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
        $this->assertEquals('0.0.4', $version->getData(), "Version is not 0.0.4");
    }

    /**
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function testPrepareUserApproval()
    {
        $operatorResponse = $this->operator->prepareUserApproval(
            'FA2DFE083495DCA999559E9A183809FB5E6F4A8F3CADB6F3EE5D91BDE03D84A9',
            1,
            [
                'message' => 'test',
                'email' => 'test@test.us'
            ],
            [
                'main' => ['*']
            ],
            [
                'user' => 'signer',
                'message' => 'signMessage',
            ],
            [
                [
                    'name' => 'signer',
                    'authentication' => [
                        'method' => 'email',
                        'value' => 'selim@tavux.tech'
                    ]
                ]
            ],
            [
                'main'
            ],
            [
                'signer' => ['main']
            ],
            null,
            [
                'success' => 'http://localhost',
                'error' => 'http://localhost/error'
            ]
        );

        $this->assertObjectHasProperty('url', $operatorResponse->getData(), "Response does not contain url");
        $this->assertObjectHasProperty('recordId', $operatorResponse->getData(), "Response does not contain recordId");
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->operator);
    }
}

