<?php

require __DIR__ . '/vendor/autoload.php';

use Src\Controllers\UserCtrl;
use Src\Database\Models\OrdersModel;
use Src\Database\Models\ChannelsModel;

$userController = new UserCtrl();
$userResult = $userController->createDefaultUser();
echo $userResult;

$ordersModel = new OrdersModel();
$createTableOrder =  $ordersModel->createTableOrdersIfNotExists();

$channelsModel = new ChannelsModel();
$createTableOrder =  $channelsModel->createTableChannelsIfNotExists();



