<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class ItemsModel
{
    public $magalu_item_id;
    public $quantity;
    public $offer;
    public $seller_id;
    public $sku_code;
    public $sku_price;
    public $total_price;
    public $item_extras;

    private static $tableName = 'items';
    public static function createTableItemIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),
                magalu_item_id  VARCHAR(255) NOT NULL,     
                quantity VARCHAR(255),
                offer VARCHAR(255),
                seller_id INT,
                sku_code VARCHAR(255),
                sku_price VARCHAR(255),
                total_price VARCHAR(255),
                item_extras VARCHAR(255),
                
                FOREIGN KEY (seller_id) REFERENCES sellers(id),
            )
        ";

        try {
            Database::execute($query);
        } catch (\Exception $e) {
            throw new \Exception('Error creating table: ' . $e->getMessage());
        }
    }


    public function itemSave()
    {
        $data = [
            'magalu_item_id' => $this->magalu_item_id,
            'quantity' => $this->quantity,
            'offer' => $this->offer,
            'seller_id' => $this->seller_id,
            'sku_code' => $this->sku_code,
            'sku_price' => $this->sku_price,
            'total_price' => $this->total_price,
            'item_extras' => $this->item_extras,
        ];

        Database::save(self::$tableName, $data);
    }
}
