<?php

session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit();
}

include("conexao.php");

// Recebe os dados do formulário
$id_pokemon = $_POST["id_pokemon"];
$id_raridade = $_POST["id_raridade"];
$quantidade = $_POST["quantidade"];

// Verifica se um Pokémon foi selecionado
if (empty($id_pokemon)) {
    echo "Selecione um Pokémon.";
    exit();
}

// Salva a carta
$sql = "INSERT INTO carta (id_pokemon, id_raridade, quantidade)
        VALUES (?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "iii",
    $id_pokemon,
    $id_raridade,
    $quantidade
);

if (mysqli_stmt_execute($stmt)) {

    header("Location: admin.php");

} else {

    echo "Erro ao cadastrar a carta.";

}

mysqli_close($conn);

?>