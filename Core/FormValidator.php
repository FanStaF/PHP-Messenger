<?php

namespace Core;

class FormValidator extends Validator
{
    
    // Validates user input from form
    // verifies as string if key is anything but 'email' or 'password'
    public static function validateFormData($formData)
    {
        $messages = [];

        foreach ($formData as $key => $value) {

            if ($key === 'email') {

                if (!static::email($value)) {
                    $messages['email'] = "Please enter a valid email.";
                }
            } else if ($key === 'password') {

                if (!static::password($value)) {
                    $messages['password'] = "Password must be between 5 and 255 characters";
                }
            } else {

                if (!static::string($value)) {
                    $messages[$key] = "Please enter a valid {$key}";
                }
            }
        }
        return $messages;
    }
}