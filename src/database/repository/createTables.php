<?php

namespace Src\Database\Repository;

use Src\Controllers\UserCtrl;
use Src\Database\Models\OrdersModel;
use Src\Database\Models\ChannelsModel;
use Src\Database\Models\AgreementsModel;
use Src\Database\Models\BuyersModel;
use Src\Database\Models\SellersModel;
use Src\Database\Models\RecipientsModel;
use Src\Database\Models\DeliveriesModel;
use Src\Database\Models\DiscountsModel;
use Src\Database\Models\PaymentsModel;
use Src\Database\Models\ProcessorsModel;
use Src\Database\Models\ItemsModel;


class CreateTables
{

    public static function CreateTablesDb()
    {
        $userController = new UserCtrl();
        $userResult = $userController->createDefaultUser();

        $processorsModel = new ProcessorsModel();
        $createTableProcessor =  $processorsModel->createTableProcessorsIfNotExists();

        $orderModel = new OrdersModel();
        $createTableOrder =  $orderModel->createTableOrderIfNotExists();

        $channelModel = new ChannelsModel();
        $createTableChannel =  $channelModel->createTableChannelIfNotExists();


        $buyerModel = new BuyersModel();
        $createTableBuyer =  $buyerModel->createTableBuyerIfNotExists();

        $recipientModel = new RecipientsModel();
        $createTableRecipient =  $recipientModel->createTableRecipientIfNotExists();

        
        $sellerModel = new SellersModel();
        $createTableSeller =  $sellerModel->createTableSellerIfNotExists();
       
        $agreementModel = new AgreementsModel();
        $createTableAgreement =  $agreementModel->createTableAgreementIfNotExists();

        $itemModel = new ItemsModel();
        $createTableItem =  $itemModel->createTableItemIfNotExists();

        $deliverieModel = new DeliveriesModel();
        $createTableDeliverie =  $deliverieModel->createTableDeliverieIfNotExists();

        $discountsModel = new DiscountsModel();
        $createTableDiscount =  $discountsModel->createTableDiscountsIfNotExists();

        $paymentsModel = new PaymentsModel();
        $createTablePayment =  $paymentsModel->createTablePaymentsIfNotExists();


    }

}
