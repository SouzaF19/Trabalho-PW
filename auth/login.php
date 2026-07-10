<?php

session_start();

include("../includes/conexao.php");

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

// Procura o usuário
$sql = "SELECT * FROM usuario WHERE usuario = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $usuario);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

// Verifica se encontrou o usuário
if(mysqli_num_rows($resultado) == 1){

    $usuario = mysqli_fetch_assoc($resultado);

    // Verifica a senha
    // Senha em texto puro (não recomendado)
    if($senha == $usuario["senha"]){

        $_SESSION["admin"] = true;
        $_SESSION["id"] = $usuario["id"];
        $_SESSION["nome"] = $usuario["nome"];

        header("Location: ../admin/admin.php");
        exit();

    }

}

// Caso dê erro
header("Location: ../index.php?erro=1");
exit();

?>