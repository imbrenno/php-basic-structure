<?php

require __DIR__ . '/vendor/autoload.php';

use Src\Controller\UserCtrl;

$userController = new UserCtrl();
$userController->index();
