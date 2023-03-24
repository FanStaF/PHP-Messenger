<?php

use Core\Database;
use Core\FormValidator;
use Core\User;

$formData = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
];

$errors = FormValidator::validateFormData($formData);

if (count($errors)) {
    return view("session/create.view.php", [
        'errors' => $errors
    ]);
} else {
    $db = new Database();

    $email = $_POST['email'];

    $user = $db->query('SELECT * from users WHERE email = :email', [
        'email' => $email
    ])->find();


    if ($user && password_verify($_POST['password'], $user['password'])) {

        login($user['userID']);
        header('location: /messages');

    } else {

        view('session/create.view.php', [
            'error' => 'Incorrect login'

        ]);
    }
}




//Retreve POST content
//verify name, lastname, email, password
//load DB
//Check compare email and password
//Log in and redirect to index.php OR redirect to login with error
