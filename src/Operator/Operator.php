<?php

namespace Carmentis\Operator;

use Carmentis\Operator\Arguments\Authentication;
use Carmentis\Operator\Arguments\Redirect;
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
     * Prepares user approval with the new parameters structure.
     *
     * @param string $applicationId Application id
     * @param int $applicationVersion Application version
     * @param array $fields Values of your record, using the predefined fields structure of your application.
     * @param array $permissions
     * @param array $approval
     * @param array $users
     * @param array $channels
     * @param array $subscriptions
     * @param null|string $flowId Optional flow identifier.
     * @param array $redirect
     * @return OperatorResponse
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function prepareUserApproval(
        string $applicationId,
        int $applicationVersion,
        array $fields,
        array $permissions,
        array $approval,
        array $users=[],
        array $channels=[],
        array $subscriptions=[],
        string $flowId=null,
        $redirect=[]
    ): OperatorResponse
    {
        $requestBody = [];

        $requestBody["application"] = $applicationId;
        $requestBody["version"] = $applicationVersion;
        $requestBody["users"] = $users;

        $requestBody["fields"] = $fields;
        $requestBody["channels"] = $channels;

        $requestBody["subscriptions"] = $subscriptions;

        $requestBody["redirect"] = $redirect;

        $requestBody["permissions"] = $permissions;

        $requestBody["approval"] = $approval;

        if ($flowId !== null) {
            $requestBody["flowId"] = $flowId;
        }

        return $this->operatorClient->sendRequest(
            new OperatorRequest('prepareUserApproval', $requestBody)
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
     * @throws OperatorRequestException
     * @throws OperatorResponseException
     */
    public function getRecordInformation(string $recordId): OperatorResponse
    {
        return $this->operatorClient->sendRequest(
            new OperatorRequest(OperatorRequest::METHOD_GET_RECORD_INFORMATION, [
                'recordId' => $recordId,
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
