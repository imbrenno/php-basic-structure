<?php

namespace Src\Controllers;

use Src\Database\Models\UsersModel;
use Src\Database\Models\Database;

class UserCtrl
{
    public function createDefaultUser()
    {
        try {
            $query = "SELECT * FROM users WHERE username = :username";
            $params = [':username' => 'admin'];
            $user = Database::getOne($query, $params);
        } catch (\Exception $e) {
            $user = null;
        }

        if ($user == null) {
            try {
                UsersModel::createTableIfNotExists();

                $newUser = new UsersModel();
                $newUser->name = 'adm';
                $newUser->email = 'adm@example.com';
                $newUser->document = '12345612312';
                $newUser->username = 'admin';
                $newUser->password = 'admin';

                $newUser->userSave();

                return 'Create';
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}
