<?php

namespace Core;

/**
 * Valitades input from user fillable forms.
 * 
 * Defaults to verify as string if $key is NOT 'email or 'password'.
 * 
 */
class FormValidator extends Validator
{
    /**
     * Validates email, password or length of string.
     * 
     * @param mixed $formData Holds user input with field name as $key
     * @return array<string> Array holding error messages.
     */
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