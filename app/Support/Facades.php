<?php

namespace App\Support;

abstract class Facades
{

    /** @var static */
    protected static $instance;


    abstract static function getAccessor() : string;

    public static function __callStatic($method, $arguments)
    {
        $instance = static::getInstance(); // get the instance of the class
        return call_user_func_array([$instance, $method], $arguments); // call the method on the instance with the arguments
    }

    public static function getInstance()
    {
        $accessorClass = static::getAccessor();
        if (static::$instance === null) {
            static::$instance = new $accessorClass;
        }

        return static::$instance;
    }

}
