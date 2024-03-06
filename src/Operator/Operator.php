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
     * @param string $application application name
     * @param $authMethod
     * @param $authId
     * @param string $messageName name of the predefined message to send to the user who will approve the record
     * @param array $field values of your record, using the predefined fields structure of your application
     * @param string $successUrl
     * @param string $cancelUrl
     * @param null $flowId
     * @return OperatorResponse
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function prepareUserApproval(string $application, $authMethod, $authId, string $messageName, array $field, string $successUrl, string $cancelUrl, $flowId=null): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest('prepareUserApproval', [
                'application' => $application,
                'flowId' => $flowId,
                'field' => $field,
                'message' => $messageName,
                'authentication' => [
                    'method' => $authMethod,
                    'id' => $authId
                ],
                'redirect' => [
                    'success' => $successUrl,
                     'cancel' => $cancelUrl
                ],
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
            new OperatorRequest('getApprovalData', [
                'merkleHash' => $merkleHash
            ])
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
