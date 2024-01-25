<?php

require __DIR__ . '/vendor/autoload.php';
require_once 'app/services/via_cep_sv.php';

use App\Services\ViaCep;

$consulta = ViaCep::consultarCep('04812223');

if ($consulta->getStatusCode() === 200) {
    $resultado = json_decode($consulta->getBody(), true);

    // Retorna o JSON como resposta
    header('Content-Type: application/json');
    echo json_encode($resultado);
} else {
    // Retorna uma mensagem de erro como JSON
    header('Content-Type: application/json');
    echo json_encode(['erro' => 'A consulta falhou. Código de status: ' . $consulta->getStatusCode()]);
}
