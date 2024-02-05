<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class RecipientsModel
{
    public $magalu_recipient_id;
    public $recipient_address;

    private static $tableName = 'recipients';
    public static function createTableRecipientIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),
                magalu_recipient_id  VARCHAR(255) NOT NULL,    
                recipient_address VARCHAR(255),
                
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
            'recipient_address' => $this->recipient_address,
        ];

        Database::save(self::$tableName, $data);
    }
}
