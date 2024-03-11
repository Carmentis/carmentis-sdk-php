<?php

namespace Carmentis\Operator\Arguments;

/**
 * Class Redirect
 * @package Carmentis\Operator\Arguments
 * @property-read string success
 * @property-read string cancel
 *
 * This class is used to redirect the user to a specific page after Carmentis has finished processing the request or if the user cancels the request
 */
class Redirect extends OperatorArgument
{

    /**
     * @var string
     *
     * The URL to redirect the user to after Carmentis has finished processing the request
     */
    protected string $success;

    /**
     * @var string
     *
     * The URL to redirect the user to if the user cancels the request
     */
    protected string $cancel;

    public function __construct(string $success, string $cancel)
    {
        $this->success = $success;
        $this->cancel = $cancel;
    }
}
