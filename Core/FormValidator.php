<?php

namespace Core;

class FormValidator extends Validator
{
    
    // Validates user input from form
    // verifies as string if key is anything but 'email' or 'password'
    public static function validateFormData($formData)
    {
        $errors = [];

        foreach ($formData as $key => $value) {

            if ($key === 'email') {

                if (!static::email($value)) {
                    $errors['email'] = "Please enter a valid email.";
                }
            } else if ($key === 'password') {

                if (!static::password($value)) {
                    $errors['password'] = "Password must be between 5 and 255 characters";
                }
            } else {

                if (!static::string($value)) {
                    $errors[$key] = "Please enter a valid {$key}";
                }
            }
        }
        return $errors;
    }
}