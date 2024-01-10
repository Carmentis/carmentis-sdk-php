<?php

namespace Carmentis\Operator;

use Carmentis\Operator\Exceptions\OperatorRequestException;

class OperatorRequest
{
    const METHOD_GET_OPERATOR_VERSION = "getOperatorVersion";
    const METHOD_SAVE_RECORD = "saveRecord";
    const METHOD_PREPARE_USER_APPROVAL = "prepareUserApproval";
    const METHOD_GET_APPROVAL_DATA = "getApprovalData";
    const METHOD_GET_RECORD_DATA = "getRecordData";
    const METHOD_CONFIRM_RECORD = "confirmRecord";

    protected string $method;

    protected array $data;

    /**
     * @throws OperatorRequestException
     */
    public function __construct(string $method, array $data)
    {
        switch ($method) {
            case self::METHOD_GET_OPERATOR_VERSION:
            case self::METHOD_SAVE_RECORD:
            case self::METHOD_PREPARE_USER_APPROVAL:
            case self::METHOD_GET_APPROVAL_DATA:
            case self::METHOD_GET_RECORD_DATA:
            case self::METHOD_CONFIRM_RECORD:
                break;
            default:
                throw new OperatorRequestException("Invalid method");
        }
        $this->method = $method;
        $this->data = $data;
    }

    public function toArray(): array
    {
        return [
            'method' => $this->method,
            'data' => json_decode(json_encode($this->data), true)
        ];
    }
}
