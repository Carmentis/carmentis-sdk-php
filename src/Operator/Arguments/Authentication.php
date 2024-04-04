<?php

namespace Carmentis\Operator\Arguments;

/**
 * Class Authentication
 * @package Carmentis\Operator\Arguments
 *
 * @property-read string $method
 * @property-read string $value
 *
 * This class is used to authenticate the user. For now, we only support the 'email' method.
 * @deprecated WILL BE REMOVED IN THE NEXT MAJOR RELEASE
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
    protected string $value;

    /**
     * Authentication constructor.
     * @param string $method
     * @param string $value
     */
    public function __construct(string $method, string $value)
    {
        $this->method = $method;
        $this->value = $value;
    }
}
