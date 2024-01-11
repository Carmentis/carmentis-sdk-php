<?php

namespace Carmentis\Operator;

use Carmentis\Operator\Exceptions\OperatorRequestException;
use Carmentis\Operator\Exceptions\OperatorResponseException;

class Operator
{
    protected OperatorClient $operatorClient;

    public function __construct(string $operatorUrl)
    {
        $this->setOperatorUrl($operatorUrl);
    }

    public function setOperatorUrl(string $operatorUrl) {
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
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function getVersion(): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('getOperatorVersion', [])
        );
    }

    /**
     * @param array|object $data
     * @return OperatorResponse
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function saveRecord($data): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('saveRecord', $data)
        )->getData();
    }

    /**
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     * @param array|object $data
     * @return OperatorResponse
     */
    public function prepareUserApproval($data): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('prepareUserApproval', $data)
        );
    }

    /**
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     * @param array|object $data
     * @return OperatorResponse
     */
    public function getApprovalData($data): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('getApprovalData', $data)
        );
    }

    /**
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     * @param array|object $data
     * @return OperatorResponse
     */
    public function getRecordData($data): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('getRecordData', $data)
        );
    }

    /**
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     * @param array|object $data
     * @return OperatorResponse
     */
    public function confirmRecord($data): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('confirmRecord', $data)
        );
    }
}
