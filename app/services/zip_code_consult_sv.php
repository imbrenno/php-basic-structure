<?php

namespace App\Services;

class ZipCodeConsult
{

    public static function consultZipCode($cep)
    {

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://viacep.com.br/ws/' . $cep . '/json/');

        if ($response->getStatusCode() === 200) {
            $result = json_decode($response->getBody(), true);
            header('Content-Type: application/json');
            echo json_encode($result);
            // print_r($resultado);
        } else {
            // Retorna uma mensagem de erro como JSON
            header('Content-Type: application/json');
            echo json_encode(['erro' => 'A consulta falhou. Código de status: ' . $response->getStatusCode()]);
        }
        return $result;
    }
}