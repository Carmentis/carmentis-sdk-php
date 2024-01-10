<?php

namespace Carmentis;

use Carmentis\Operator\Exceptions\OperatorResponseException;

/**
 * Class CarmentisOperatorResponse
 * @package Carmentis
 */
class CarmentisOperatorResponse
{
    protected $data;

    /**
     * @param $response
     * @throws OperatorResponseException
     */
    public function __construct($response)
    {
        $response = is_string($response) ? json_decode($response) : $response;

        if(!isset($response->success) || $response->success === false) {
            throw new OperatorResponseException($response->error);
        }else{
            $this->data = $response->data;
        }
    }
}
