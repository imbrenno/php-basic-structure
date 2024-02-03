<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class RecipientModel
{
    public $magalu_recipient_id;
    public $agreement_id;
    public $recipient_address;

    private static $tableName = 'recipients';
    public static function createTableRecipientIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),
                magalu_recipient_id  VARCHAR(255) NOT NULL,
                agreement_id INT NOT NULL,         
                recipient_address VARCHAR(255),
                
                FOREIGN KEY (agreement_id) REFERENCES agreements(id)
            )
        ";

        try {
            Database::execute($query);
        } catch (\Exception $e) {
            throw new \Exception('Error creating table: ' . $e->getMessage());
        }
    }


    public function recipeintSave()
    {
        $data = [
            'magalu_recipient_id' => $this->magalu_recipient_id,
            'agreement_id' => $this->agreement_id,
            'recipient_address' => $this->recipient_address,
        ];

        Database::save(self::$tableName, $data);
    }
}
