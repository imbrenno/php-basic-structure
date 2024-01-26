<?php

namespace App\Controller;

use App\Model\User;  // Certifique-se de usar o namespace correto para a classe User

class UserController
{
    public function index()
    {
        // Cria a tabela se não existir
        try {
            User::createTableIfNotExists();

            $newUser = new User();
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
