<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class SellerModel
{


    public $magalu_seller_id;
    public $agreement_id;
    public $seller_external_id;

    private static $tableName = 'sellers';
    public static function createTableSellerIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),
                magalu_seller_id  VARCHAR(255) NOT NULL,
                agreement_id INT NOT NULL,         
                seller_external_id VARCHAR(255),
                
                FOREIGN KEY (agreement_id) REFERENCES agreements(id)
            )
        ";

        try {
            Database::execute($query);
        } catch (\Exception $e) {
            throw new \Exception('Error creating table: ' . $e->getMessage());
        }
    }


    public function sellerSave()
    {
        $data = [
            'magalu_seller_id' => $this->magalu_seller_id,
            'agreement_id' => $this->agreement_id,
            'seller_external_id' => $this->seller_external_id,
        ];

        Database::save(self::$tableName, $data);
    }
}
