<?php

namespace Carmentis\Operator\Arguments;

/**
 * Class Subscription
 * @package Carmentis\Operator\Arguments
 *
 * @property-read User $user
 * @property-read string[] $channelNames
 */
class Subscription extends OperatorArgument
{
    /**
     * @var User
     *
     *
     */
    protected User $user;

    /**
     * @var string[] $channelNames
     */
    protected array $channelNames;

    public function __construct(User $user, array $channelNames)
    {
        $this->user = $user;
        $this->channelNames = $channelNames;
    }
}
