<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "banco_pokemon";

$conn = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conn) {
    die("Erro na conexão");
}

?>