<?php

namespace Api\services;

class Service
{

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return static::make()->{$name}(...$arguments);
    }

    public static function make(): static
    {
        return new static();
    }

}
