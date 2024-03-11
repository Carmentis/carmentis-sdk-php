<?php

namespace Carmentis\Operator\Arguments;

/**
 * Class Authentication
 * @package Carmentis\Operator\Arguments
 *
 * @property-read string method
 * @property-read string identifier
 *
 * This class is used to authenticate the user. For now, we only support the 'email' method.
 */
class Authentication extends OperatorArgument
{
    /**
     * @var string
     *
     * For now, we only support the 'email' method
     */
    protected string $method;

    /**
     * @var string
     *
     * The identifier for the authentication method (email value for now)
     */
    protected string $identifier;

    /**
     * Authentication constructor.
     * @param string $method
     * @param string $identifier
     */
    public function __construct(string $method, string $identifier)
    {
        $this->method = $method;
        $this->identifier = $identifier;
    }
}
