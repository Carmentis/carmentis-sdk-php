<?php

namespace Carmentis\Operator;

use Carmentis\Operator\Exceptions\OperatorRequestException;
use Carmentis\Operator\Exceptions\OperatorResponseException;

/**
 * Class Operator
 * @package Carmentis\Operator
 */
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

    public function getClient(): OperatorClient
    {
        return $this->operatorClient;
    }

    /**
     * @return OperatorResponse
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function getOperatorVersion(): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('getOperatorVersion', [])
        );
    }

    /**
     * @param string $application
     * @param array $field
     * @return OperatorResponse
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function saveRecord(string $application, array $field): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('saveRecord', [
                'application' => $application,
                'field' => $field
            ])
        )->getData();
    }

    /**
     * @param string $application
     * @param array $field
     * @param string $redirectUrl
     * @return OperatorResponse
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function prepareUserApproval(string $application, array $field, string $redirectUrl): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('prepareUserApproval', [
                'application' => $application,
                'field' => $field,
                'redirectUrl' => $redirectUrl
            ])
        );
    }

    /**
     * @param string $merkleHash
     * @return OperatorResponse
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function getApprovalData(string $merkleHash): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('getApprovalData', $merkleHash)
        );
    }

    /**
     * @param string $merkleHash
     * @param string[] $accessRules list of fields to decipher in order to be display to the current service provider's user (in a proof page for example). Use * to decipher all fields (default). You (as a service provider) should set it in accordance with your user's role & permissions.
     * @return OperatorResponse
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function getRecordData(string $merkleHash, array $accessRules=['*']): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('getRecordData', [
                'merkleHash' => $merkleHash,
                'accessRules' => implode(',', $accessRules)
            ])
        );
    }

    /**
     * @param string $merkleHash
     * @return OperatorResponse
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function confirmRecord(string $merkleHash): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('confirmRecord', [
                'merkleHash' => $merkleHash
            ])
        );
    }
}
