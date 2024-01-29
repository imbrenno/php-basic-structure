<?php

namespace Src\Controller;

use Src\Database\Models\UserModel;  // Certifique-se de usar o namespace correto para a classe User

class UserCtrl
{
    public function index()
    {
        // Cria a tabela se não existir
        try {
            UserModel::createTableIfNotExists();

            $newUser = new UserModel();
            $newUser->name = 'adm';
            $newUser->email = 'adm@example.com';
            $newUser->document = '12345612312';
            $newUser->username = 'admin';
            $newUser->password = 'admin';

            $newUser->save();
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
