<?php

logout($_SESSION['userId']);

header('location: /login');