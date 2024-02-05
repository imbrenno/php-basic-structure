<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class BuyersModel
{


    public $magalu_buyer_id;
    public $buyer_name;
    public $buyer_document;



    private static $tableName = 'buyers';
    public static function createTableBuyerIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),     
                buyer_name VARCHAR(255),
                buyer_document VARCHAR(14),

            )
        ";

        try {
            Database::execute($query);
        } catch (\Exception $e) {
            throw new \Exception('Error creating table: ' . $e->getMessage());
        }
    }


    public function buyerSave()
    {
        $data = [
            'magalu_buyer_id' => $this->magalu_buyer_id,
            'buyer_name' => $this->buyer_name,
            'buyer_document' => $this->buyer_document,
        ];

        Database::save(self::$tableName, $data);
    }
}
