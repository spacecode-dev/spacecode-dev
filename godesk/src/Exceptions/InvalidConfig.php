<?php

namespace SpaceCode\GoDesk\Exceptions;

use Exception;

class InvalidConfig extends Exception
{
    public static function driverNotSupported(): InvalidConfig
    {
        return new static(__('Driver not supported. Please check your configuration'));
    }
}