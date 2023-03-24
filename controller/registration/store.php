<?php

use Core\Database;
use Core\FormValidator;

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

// check if email already in db
$db = new Database();

$email = $_POST['email'];

$user = $db->query('SELECT * from users WHERE email = :email', [
    'email' => $email
])->find();


if ($user) {
    // Email exists: send to login
    return view('session/create.view.php', ['Email already exists. Please login.']);

} else {
    // Create new user
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

    $ID = $user['userID'];
    login($ID);

    header('location: /messages');
}
