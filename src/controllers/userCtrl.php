<?php

namespace Src\Controllers;

use Src\Database\Models\UserModel;
use Src\Database\Models\Database;

class UserCtrl
{
    public function createDefaultUser()
    {
        try {
            $user = Database::getOne('users', '1');
        } catch (\Exception $e) {
            $user = null;
        }

        if ($user == null) {
            try {
                UserModel::createTableIfNotExists();

                $newUser = new UserModel();
                $newUser->name = 'adm';
                $newUser->email = 'adm@example.com';
                $newUser->document = '12345612312';
                $newUser->username = 'admin';
                $newUser->password = 'admin';

                $newUser->save();

                return 'Create';
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
    public function newUser()
    {
        try {
            $user = Database::getOne('users', '1');
        } catch (\Exception $e) {
            $user = null;
        }

        if ($user == null) {
            try {
                
                $newUser = new UserModel();
                $newUser->name = 'adm';
                $newUser->email = 'adm@example.com';
                $newUser->document = '12345612312';
                $newUser->username = 'admin';
                $newUser->password = 'admin';

                $newUser->save();

                return 'Create';
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}
