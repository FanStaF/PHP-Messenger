<?php

namespace Core;

class Validator
{
public static function string($input, $min = 1, $max = 255)
    {
        return strlen($input) >= $min && strlen($input) < $max;
    }

    public static function email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function password($password)
    {
        return static::string($password, 5, 255);
    }
}