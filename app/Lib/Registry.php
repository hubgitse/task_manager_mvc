<?php

namespace app\Lib;

class Registry
{
    private static $services = [];


    private static $parameters = [];

    private static $isReadOnly = false;

    public static function get($name)
    {
        if (!array_key_exists($name, self::$services)) {
            throw new \InvalidArgumentException();
        }

        return self::$services[$name];
    }

    public static function set($name, $object)
    {
        if (self::$isReadOnly === true) {
            throw new \RuntimeException('Registry is read only');
        }

        self::$services[$name] = $object;
    }

    public static function getParameter($name)
    {
        if (!array_key_exists($name, self::$parameters)) {
            throw new \InvalidArgumentException();
        }

        return self::$parameters[$name];
    }

    public static function setParameter($name, $value)
    {
        if (self::$isReadOnly === true) {
            throw new \RuntimeException('Registry is read only');
        }

        self::$parameters[$name] = $value;
    }

    public static function readOnly()
    {
        self::$isReadOnly = true;
    }
}
