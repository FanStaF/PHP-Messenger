<?php

$router->get('/', 'controller/index.php');

$router->get('/registration', 'controller/registration/create.php');
$router->post('/registration', 'controller/registration/store.php');

$router->get('/login', 'controller/session/create.php');
$router->post('/session', 'controller/session/store.php');
$router->get('/logout', 'controller/session/destroy.php');

$router->get('/messages', 'controller/messages/index.php');
$router->post('/messages', 'controller/messages/create.php');
$router->put('/messages', 'controller/messages/store.php');

$router->get('/friends', 'controller/friends/index.php');