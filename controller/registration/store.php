<?php

use Core\Database;
use Core\FormValidator;
use Core\User;

$formData = [
    'firstname' => $_POST['firstname'],
    'lastname' => $_POST['lastname'],
    'email' => $_POST['email'],
    'password' => $_POST['password']
];

$errors = FormValidator::validateFormData($formData);

if (count($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}


$db = new Database();

$email = $_POST['email'];

$user = $db->query('SELECT * from users WHERE email = :email', [
    'email' => $email
])->find();


if ($user) {
    return view('session/create.view.php', ['Email already exists. Please login.']);

} else {
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $db->query("INSERT INTO users (firstname, lastname, email, password) VALUES(:firstname, :lastname, :email, :password)", [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'password' => $password
    ]);
    $user = $db->query("SELECT * FROM users WHERE email = :email", [
        'email' => $_POST['email']
    ])->find();

    $id = $user['userId'];
    login($id);

    header('location: /messages');

}





//Retreve POST content
//verify name, lastname, email, password
//load DB
//Check compare email and password
//Log in and redirect to index.php OR redirect to login with error
