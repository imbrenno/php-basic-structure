<?php

require __DIR__ . '/vendor/autoload.php';

use Src\Controllers\UserCtrl;
use Src\Database\Models\OrderModel;
use Src\Database\Models\ChannelModel;
use Src\Database\Models\AgreementModel;
use Src\Database\Models\BuyerModel;
use Src\Database\Models\SellerModel;
use Src\Database\Models\RecipientModel;

$userController = new UserCtrl();
$userResult = $userController->createDefaultUser();

$orderModel = new OrderModel();
$createTableOrder =  $orderModel->createTableOrderIfNotExists();

$channelModel = new ChannelModel();
$createTableChannel =  $channelModel->createTableChannelIfNotExists();

$agreementModel = new AgreementModel();
$createTableAgreement =  $agreementModel->createTableAgreementIfNotExists();

$sellerModel = new SellerModel();
$createTableSeller =  $sellerModel->createTableSellerIfNotExists();

$buyerModel = new BuyerModel();
$createTableBuyer =  $buyerModel->createTableBuyerIfNotExists();

$recipientModel = new RecipientModel();
$createTableRecipient =  $recipientModel->createTableRecipientIfNotExists();

