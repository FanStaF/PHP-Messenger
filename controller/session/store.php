<?php

use Core\Database;
use Core\FormValidator;

$formData = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
];

$errors = FormValidator::validateFormData($formData);

if (count($errors)) {
    // erros found: send back to fix
    return view("session/create.view.php", [
        'errors' => $errors
    ]);
} else {
    // form data is valid
    $db = new Database();

    $email = $_POST['email'];

    // Check that email exists
    $user = $db->query('SELECT * from users WHERE email = :email', [
        'email' => $email
    ])->find();


    if ($user && password_verify($_POST['password'], $user['password'])) {
        // email and password valid
        login($user['userID']);
        header('location: /messages');

    } else {
        // email missing from db OR incorrect password
        view('session/create.view.php', [
            'error' => 'Incorrect login'

        ]);
    }
}
