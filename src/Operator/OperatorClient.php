<?php

namespace Carmentis\Operator;

use Carmentis\Operator\Exceptions\OperatorResponseException;
use Carmentis\Operator\OperatorResponse;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Client
 * @package Carmentis
 */
class OperatorClient
{
    protected string $operatorUrl;

    protected GuzzleClient $guzzle;

    /**
     * @param string $operatorUrl
     * @param string $appName
     */
    public function __construct(string $operatorUrl)
    {
        $this->operatorUrl = $operatorUrl;

        $this->guzzle = new GuzzleClient([
            'base_uri' => $this->operatorUrl,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @throws OperatorResponseException
     */
    public function sendRequest(OperatorRequest $request): OperatorResponse
    {
        try {
            return new OperatorResponse(
                $this->guzzle->request(
                    'POST',
                    $this->operatorUrl,
                    $request->toArray()
                )->getBody()->getContents()
            );
        } catch (GuzzleException $e) {
            throw new OperatorResponseException($e->getMessage());
        }
    }
}
