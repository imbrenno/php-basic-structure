<?php

namespace App\Model;

class Database
{
    private static $connection;

    private static function connect()
    {
        include __DIR__ . '/../../settings/settings.php';

        if (!isset(self::$connection)) {
            try {
                self::$connection = new \PDO(DRIVER_BD . ':Server=' . SERVER . ';Database=' . DATABASE, USER, PASSWORD);
                self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $error) {
                throw new \Exception('Connection Error: ' . $error->getMessage());
            }
        }
    }

    public static function execute($query, $params = [])
    {
        try {
            self::connect();
            $stmt = self::$connection->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (\PDOException $error) {
            throw new \Exception('Database Error: ' . $error->getMessage() . '<br>QUERY: ' . $query . '<br>PARAMS: ' . print_r($params, true));
        }
    }


    public static function getOne($table, $id)
    {
        $query = "SELECT * FROM $table WHERE id = :id";
        $params = [':id' => $id];
        $result = self::execute($query, $params);
        return $result->fetchObject();
    }

    public static function getAll($table)
    {
        $query = "SELECT * FROM $table";
        $result = self::execute($query);
        return $result->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function save($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', :', array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES (:$values)";
        self::execute($query, $data);
    }

    public static function delete($table, $id)
    {
        $query = "DELETE FROM $table WHERE id = :id";
        $params = [':id' => $id];
        self::execute($query, $params);
    }
}
