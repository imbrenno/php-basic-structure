<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class ProcessorsModel
{

    public $magalu_processor_id;
    public $processor_extras;
    private static $tableName = 'processors';
    public static function createTableProcessorsIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),
                magalu_processor_id  VARCHAR(255) NOT NULL,
                processor_extras INT NOT NULL,         

            )
        ";

        try {
            Database::execute($query);
        } catch (\Exception $e) {
            throw new \Exception('Error creating table: ' . $e->getMessage());
        }
    }


    public function processorSave()
    {
        $data = [
            'magalu_processor_id' => $this->magalu_processor_id,
            'processor_extras' => $this->processor_extras,
        ];

        Database::save(self::$tableName, $data);
    }
}
