<?php

use Core\CurrentUser;

$currentUser = new CurrentUser($_SESSION['user']);

viewWithUser('messages/index.view.php', $currentUser);
