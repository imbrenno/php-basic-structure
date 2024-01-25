<?php

namespace App\Services;

class ViaCep
{

    public static function consultarCep($cep)
    {
    
        $client = new \GuzzleHttp\Client();
        return $client->request('GET', 'http://viacep.com.br/ws/'.$cep.'/json/');
           
    }

}
