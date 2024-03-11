<?php

namespace Carmentis\Operator\Arguments;

abstract class OperatorArgument
{
    public function __get($name)
    {
        if(!property_exists($this, $name)) {
            throw new \InvalidArgumentException("Property $name does not exist");
        }
        return $this->$name;
    }
}
