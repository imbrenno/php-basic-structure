<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class DeliveriesModel
{


    public $magalu_delivery_id;
    public $agreement_id;
    public $quantity;
    public $item_id;
    public $recipient_id;
    public $total_price;
    public $delivery_extras;
    public $order_id;



    private static $tableName = 'deliveries';
    public static function createTableDeliverieIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),
                magalu_delivery_id  VARCHAR(255) NOT NULL,
                agreement_id INT NOT NULL,         
                quantity INT,
                item_id INT NOT NULL,
                recipient_id INT NOT NULL,
                total_price VARCHAR(50),
                delivery_extras VARCHAR(255),
                order_id INT NOT NULL,
                
                FOREIGN KEY (agreement_id) REFERENCES agreements(id),
                FOREIGN KEY (item_id) REFERENCES items(id),
                FOREIGN KEY (recipient_id) REFERENCES recipients(id),
                FOREIGN KEY (order_id) REFERENCES orders(id),
            )
        ";

        try {
            Database::execute($query);
        } catch (\Exception $e) {
            throw new \Exception('Error creating table: ' . $e->getMessage());
        }
    }


    public function deliverieSave()
    {
        $data = [
            'magalu_delivery_id' => $this->magalu_delivery_id,
            'agreement_id' => $this->agreement_id,
            'quantity' => $this->quantity,
            'item_id' => $this->item_id,
            'recipient_id' => $this->recipient_id,
            'total_price' => $this->total_price,
            'delivery_extras' => $this->delivery_extras,
            'order_id' => $this->order_id,
        ];

        Database::save(self::$tableName, $data);
    }
}
