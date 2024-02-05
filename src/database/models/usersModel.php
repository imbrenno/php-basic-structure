<?php

namespace Src\Database\Models;

use Src\Database\Models\Database;

class UsersModel
{
    private static $tableName = 'users';

    // Propriedades para os campos do usuário
    public $name;
    public $email;
    public $document;
    public $username;
    public $password;

    public static function createTableIfNotExists()
    {
        $query = "
            IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='" . self::$tableName . "' AND xtype='U')
            CREATE TABLE " . self::$tableName . " (
                id INT PRIMARY KEY IDENTITY(1,1),
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                document VARCHAR(14) NOT NULL,
                username VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL
            )
        ";

        try {
            Database::execute($query);
        } catch (\Exception $e) {
            throw new \Exception('Error creating table: ' . $e->getMessage());
        }
    }


    public function userSave()
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'document' => $this->document,
            'username' => $this->username,
            'password' => $this->password,
        ];

        Database::save(self::$tableName, $data);
    }
}
