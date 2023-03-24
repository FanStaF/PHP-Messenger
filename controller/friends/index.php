<?php

use Core\CurrentUser;

$currentUser = new CurrentUser($_SESSION['user']);

viewWithUser('friends/index.view.php', $currentUser);