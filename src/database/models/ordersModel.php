<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class OrdersModel
{


    public $magalu_order_id;
    public $created_at;
    public $code;
    public $parent;
    public $purchased_at;
    public $currency;
    public $normalizer;
    public $total_items_price;
    public $total_payments;
    public $total_discounts;
    public $total_deliveries;

    private static $tableName = 'orders';
    public static function createTableOrderIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),
                magalu_order_id  VARCHAR(255) NOT NULL,
                created_at VARCHAR(255) NOT NULL,
                code VARCHAR(255) NOT NULL,
                parent VARCHAR(14),
                purchased_at VARCHAR(14) NOT NULL,
                currency VARCHAR(14) NOT NULL,
                normalizer VARCHAR(14) NOT NULL,
                total_items_price VARCHAR(25) NOT NULL,
                total_payments VARCHAR(25) NOT NULL,
                total_discounts VARCHAR(25) NOT NULL,
                total_deliveries VARCHAR(25) NOT NULL,               
            )
        ";

        try {
            Database::execute($query);
        } catch (\Exception $e) {
            throw new \Exception('Error creating table: ' . $e->getMessage());
        }
    }


    public function orderSave()
    {
        $data = [
            'magalu_order_id' => $this->magalu_order_id,
            'created_at' => $this->created_at,
            'code' => $this->code,
            'parent' => $this->parent,
            'purchased_at' => $this->purchased_at,
            'currency' => $this->currency,
            'normalizer' => $this->normalizer,
            'total_items_price' => $this->total_items_price,
            'total_payments' => $this->total_payments,
            'total_discounts' => $this->total_discounts,
            'total_deliveries' => $this->total_deliveries,
        ];

        Database::save(self::$tableName, $data);
    }
}
