<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class ChannelsModel
{


    public $magalu_channel_id;
    public $order_id;
    public $channel_extras;



    private static $tableName = 'channels';
    public static function createTableChannelsIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),
                magalu_channel_id  VARCHAR(255) NOT NULL,
                order_id INT NOT NULL,         
                channel_extras VARCHAR(400) NOT NULL,
                
                FOREIGN KEY (order_id) REFERENCES orders(id)
            )
        ";

        try {
            Database::execute($query);
        } catch (\Exception $e) {
            throw new \Exception('Error creating table: ' . $e->getMessage());
        }
    }


    public function OrderSave()
    {
        $data = [
            'magalu_channel_id' => $this->magalu_channel_id,
            'order_id' => $this->order_id,
            'channel_extras' => $this->channel_extras,
        ];

        Database::save(self::$tableName, $data);
    }
}
