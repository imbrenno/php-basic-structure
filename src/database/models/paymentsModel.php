<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class PaymentsModel
{

    public $magalu_payment_id;
    public $agreement_id;
    public $processor_id;
    public $method;
    public $value;
    public $payment_extras;

    private static $tableName = 'payments';
    public static function createTablePaymentsIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),
                magalu_payment_id  VARCHAR(255) NOT NULL,
                agreement_id INT NOT NULL,         
                processor_id INT NOT NULL,
                method VARCHAR(250) NOT NULL,
                value VARCHAR(50) NOT NULL,
                payment_extras VARCHAR(250) NOT NULL,
                
                FOREIGN KEY (agreement_id) REFERENCES agreements(id),
                FOREIGN KEY (processor_id) REFERENCES processors(id),
            )
        ";

        try {
            Database::execute($query);
        } catch (\Exception $e) {
            throw new \Exception('Error creating table: ' . $e->getMessage());
        }
    }


    public function paymentSave()
    {
        $data = [
            'magalu_payment_id' => $this->magalu_payment_id,
            'agreement_id' => $this->agreement_id,
            'processor_id' => $this->processor_id,
            'method' => $this->method,
            'value' => $this->value,
            'payment_extras' => $this->payment_extras,
        ];

        Database::save(self::$tableName, $data);
    }
}
