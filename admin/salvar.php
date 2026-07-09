<?php

session_start();

include("../includes/conexao.php");


// Verifica se o usuário está logado
if(!isset($_SESSION["id"])){
    header("Location: ../index.php");
    exit();
}


// Recebe os dados do formulário
$id = $_POST["id"];
$nome = $_POST["nome"];
$numero_pokedex = $_POST["numero_pokedex"];
$tipo = $_POST["tipo"];
$imagem_url = $_POST["imagem_url"];
$descricao = $_POST["descricao"];


// Insere o Pokémon no banco
$sql = "INSERT INTO pokemon 
(id, nome, numero_pokedex, tipo, imagem_url, descricao)
VALUES (?, ?, ?, ?, ?, ?)";


$stmt = mysqli_prepare($conn, $sql);


mysqli_stmt_bind_param(
    $stmt,
    "isisss",
    $id,
    $nome,
    $numero_pokedex,
    $tipo,
    $imagem_url,
    $descricao
);


// Executa
if(mysqli_stmt_execute($stmt)){

    header("Location: admin.php?sucesso=1");
    exit();

}else{

    echo "Erro ao salvar Pokémon: " . mysqli_error($conn);

}

?>