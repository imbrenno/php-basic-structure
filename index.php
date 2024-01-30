<?php

require __DIR__ . '/vendor/autoload.php';

use Src\Controllers\UserCtrl;

$userController = new UserCtrl();
$result = $userController->createDefaultUser();
echo $result;

