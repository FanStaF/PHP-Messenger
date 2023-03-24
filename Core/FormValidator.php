<?php

namespace Core;

//
// Validates input from user fillable forms.
// Always verifies as string if $key is anything
// but 'email' or 'password'
//
class FormValidator extends Validator
{
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