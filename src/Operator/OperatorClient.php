<?php

namespace Carmentis\Operator;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Client
 * @package Carmentis
 */
class CarmentisOperatorClient
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
     * @return string
     */
    public function getOperatorUrl()
    {
        return $this->operatorUrl;
    }

    /**
     * @return string
     */
    public function getAppName()
    {
        return $this->appName;
    }


    /**
     * @throws ResponseException
     */
    public function sendRequest(CarmentisOperatorRequest $request) {
        try {
            return new CarmentisResponse(
                $this->guzzle->request(
                    'POST',
                    $this->operatorUrl,
                    $request->toArray()
                )->getBody()->getContents()
            );
        } catch (GuzzleException $e) {
            throw new ResponseException($e->getMessage());
        }
    }
}
