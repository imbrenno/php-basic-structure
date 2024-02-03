<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class AgreementModel
{


    public $magalu_agreement_id;
    public $order_id;
    public $buyer_id;
    public $seller_id;
    public $recipient_id;
    public $total_items_price;
    public $total_payments;
    public $total_discounts;
    public $total_deliveries;



    private static $tableName = 'agreements';
    public static function createTableAgreementIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),
                magalu_agreement_id  VARCHAR(255) NOT NULL,
                order_id INT NOT NULL,         
                buyer_id INT NOT NULL,         
                seller_id INT NOT NULL,       
                recipient_id INT NOT NULL,       
                total_items_price VARCHAR(25) NOT NULL,
                total_payments VARCHAR(25) NOT NULL,
                total_discounts VARCHAR(25) NOT NULL,
                total_deliveries VARCHAR(25) NOT NULL,
                
                FOREIGN KEY (order_id) REFERENCES orders(id)
                FOREIGN KEY (buyer_id) REFERENCES buyers(id)
                FOREIGN KEY (seller_id) REFERENCES sellers(id)
                FOREIGN KEY (recipient_id) REFERENCES recipients(id)
            )
        ";

        try {
            Database::execute($query);
        } catch (\Exception $e) {
            throw new \Exception('Error creating table: ' . $e->getMessage());
        }
    }


    public function agreementSave()
    {
        $data = [
            'magalu_agreement_id' => $this->magalu_agreement_id,
            'order_id' => $this->order_id,
            'buyer_id' => $this->buyer_id,
            'seller_id' => $this->seller_id,
            'recipient_id' => $this->recipient_id,
            'total_items_price' => $this->total_items_price,
            'total_payments' => $this->total_payments,
            'total_discounts' => $this->total_discounts,
            'total_deliveries' => $this->total_deliveries,
        ];

        Database::save(self::$tableName, $data);
    }
}
