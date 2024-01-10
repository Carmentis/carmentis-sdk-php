<?php

namespace Carmentis\Operator;

class CarmentisOperator
{
    protected CarmentisOperatorClient $operatorClient;

    public function __construct(string $operatorUrl)
    {
        $this->operatorClient = new CarmentisOperatorClient($operatorUrl);
    }

    /**
     * @return CarmentisResponse
     */
    public function getVersion(){
        return $this->operatorClient->sendRequest(
            new CarmentisOperatorRequest('getOperatorVersion', [])
        );
    }
}
