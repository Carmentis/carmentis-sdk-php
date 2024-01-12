<?php

namespace Carmentis\Operator;

use Carmentis\Operator\Exceptions\OperatorResponseException;

/**
 * Class CarmentisOperatorResponse
 * @package Carmentis
 */
class OperatorResponse
{
    protected $data = [];

    /**
     * @param string $response
     * @throws OperatorResponseException
     */
    public function __construct(string $response)
    {
        $response = is_string($response) ? json_decode($response) : $response;

        if(!isset($response->success) || $response->success === false) {
            throw new OperatorResponseException($response->error ?? 'Unknown error');
        }else{
            if(isset($response->data)){
                $this->data = $response->data;
            }
        }
    }

    public function getData() {
        return $this->data;
    }
}
