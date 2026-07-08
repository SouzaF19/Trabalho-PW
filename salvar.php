<?php

session_start();

include("conexao.php");

// Verifica se o usuário está logado
if(!isset($_SESSION["id"])){
    header("Location: index.php");
    exit();
}


// Recebe os dados do formulário
$nome = $_POST["nome"];
$tipo = $_POST["tipo"];
$imagem = $_POST["imagem"];
$descricao = $_POST["descricao"];


// Insere no banco
$sql = "INSERT INTO pokemon (nome, tipo, imagem, descricao) 
        VALUES (?, ?, ?, ?)";


$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssss",
    $nome,
    $tipo,
    $imagem,
    $descricao
);


// Executa
if(mysqli_stmt_execute($stmt)){

    header("Location: admin.php?sucesso=1");
    exit();

}else{

    echo "Erro ao salvar: " . mysqli_error($conn);

}

?>