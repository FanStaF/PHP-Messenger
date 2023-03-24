<?php

// Front page
$router->get('/', 'controller/index.php');

// Register new user
$router->get('/registration', 'controller/registration/create.php');
$router->post('/registration', 'controller/registration/store.php');

// Log in/out
$router->get('/login', 'controller/session/create.php');
$router->post('/session', 'controller/session/store.php');
$router->get('/logout', 'controller/session/destroy.php');

// messages
$router->get('/messages', 'controller/messages/index.php');
$router->post('/messages', 'controller/messages/create.php');
$router->put('/messages', 'controller/messages/store.php');

// Manage friends
$router->get('/friends', 'controller/friends/index.php');
$router->post('/friends', 'controller/friends/store.php');