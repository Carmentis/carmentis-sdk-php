<?php

namespace Carmentis\Operator;

use Carmentis\Operator\Exceptions\OperatorRequestException;
use Carmentis\Operator\Exceptions\OperatorResponseException;

class Operator
{
    protected OperatorClient $operatorClient;

    public function __construct(string $operatorUrl)
    {
        $this->operatorClient = new OperatorClient($operatorUrl);
    }

    /**
     * @return OperatorClient
     */
    public function getClient() {
        return $this->operatorClient;
    }

    /**
     * @return OperatorResponse
     * @throws OperatorResponseException|OperatorRequestException
     */
    public function getVersion(){
        return $this->operatorClient->sendRequest(
            new OperatorRequest('getOperatorVersion', [])
        );
    }
}
