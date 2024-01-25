<?php

use App\WebService\ViaCep;

// Supondo que o método consultarCep retorne a resposta do Guzzle
$consulta = ViaCep::consultarCep('04812223');

// Verifica se a consulta foi bem-sucedida antes de usar var_dump
if ($consulta->getStatusCode() === 200) {
    // Converte o corpo da resposta JSON para uma matriz associativa
    $resultado = json_decode($consulta->getBody(), true);

    // Imprime o resultado usando var_dump
    var_dump($resultado);
} else {
    echo "A consulta falhou. Código de status: " . $consulta->getStatusCode();
}
