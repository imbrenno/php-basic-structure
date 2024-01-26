<?php

require __DIR__ . '/vendor/autoload.php';

use App\Controller\UserController;

$userController = new UserController();
$userController->index();
