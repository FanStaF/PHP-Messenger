<?php
use Core\User;

$currentUser = new User($_SESSION['user']);

viewWithUser('session/index.view.php', $currentUser);
exit();