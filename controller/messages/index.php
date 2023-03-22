<?php
use Core\User;

$currentUser = new User($_SESSION['user']);

viewWithUser('messages/index.view.php', $currentUser);
exit();