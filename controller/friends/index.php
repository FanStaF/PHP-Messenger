<?php

use Core\User;

$currentUser = new User($_SESSION['user']);


viewWithUser('friends/index.view.php', $currentUser);