<?php

namespace Core;

//
// Validates:
//      string is of acceptable length
//      email is a valid emailaddress
//      password is of accaptable length
//
class Validator
{

    // Validate length of string
    public static function string($input, $min = 1, $max = 255)
    {
        return strlen($input) >= $min && strlen($input) < $max;
    }

    // Validate email
    public static function email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Validate length of password
    public static function password($password)
    {
        // To Do: Add other password requirements
        return static::string($password, 5, 255);
    }
}