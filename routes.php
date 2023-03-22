<?php

$router->get('/', 'controller/index.php');

$router->get('/login', 'controller/session/create.php');
$router->post('/session', 'controller/session/store.php');
$router->get('/session', 'controller/session/index.php');
$router->get('/logout', 'controller/session/destroy.php');

$router->get('/register', 'controller/registration/create.php');
$router->post('/registration', 'controller/registration/store.php');

$router->get('/messages', 'controller/messages/create.php');
$router->post('/messages', 'controller/messages/store.php');
$router->get('/friends', 'controller/friends/index.php');
