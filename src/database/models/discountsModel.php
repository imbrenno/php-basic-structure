<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class DiscountsModel
{

    public $magalu_discount_id;
    public $agreement_id;
    public $apply_item_to_id;
    public $value;
    public $discount_extras;

    private static $tableName = 'discounts';
    public static function createTableDiscountsIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),
                magalu_discount_id  VARCHAR(255) NOT NULL,
                agreement_id INT NOT NULL,         
                apply_item_to_id INT,
                value INT NOT NULL,
                discount_extras INT NOT NULL,
                
                FOREIGN KEY (agreement_id) REFERENCES agreements(id),
                FOREIGN KEY (apply_item_to_id) REFERENCES items(id),

            )
        ";

        try {
            Database::execute($query);
        } catch (\Exception $e) {
            throw new \Exception('Error creating table: ' . $e->getMessage());
        }
    }


    public function disconuntSave()
    {
        $data = [
            'magalu_discount_id' => $this->magalu_discount_id,
            'agreement_id' => $this->agreement_id,
            'apply_item_to' => $this->apply_item_to_id,
            'value' => $this->value,
            'discount_extras' => $this->discount_extras,
        ];

        Database::save(self::$tableName, $data);
    }
}
