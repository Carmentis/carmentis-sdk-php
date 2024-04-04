<?php

namespace Carmentis\Operator\Arguments;

/**
 * Class User
 * @package Carmentis\Operator\Arguments
 *
 * @property-read string $name
 * @property-read string $identifier
 */
class User extends OperatorArgument
{
    /**
     * @var string
     *
     *
     */
    protected string $name;

    /**
     * @var Authentication $authentication
     *
     * @deprecated WILL BE REMOVED IN THE NEXT MAJOR RELEASE
     */
    protected Authentication $authentication;

    /**
     * User constructor.
     * @param string $name
     * @param Authentication|null $authentication
     */
    public function __construct(string $name, Authentication $authentication=null)
    {
        $this->name = $name;
        $this->authentication = $authentication;
    }
}
