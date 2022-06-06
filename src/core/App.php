<?php

class App
{

    protected static $repo = [];

    public static function register(string $key, $service)
    {
        static::$repo[$key] = $service;
    }

    public static function get(string $key)
    {
        if (array_key_exists($key, static::$repo)) {
            return static::$repo[$key];
        }
        throw new Exception("No service provider");
    }
}