<?php

include("conexao.php");

$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = $_POST["senha"];

// Remove caracteres perigosos
$nome = mysqli_real_escape_string($conn, $nome);
$email = mysqli_real_escape_string($conn, $email);

// Criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Verifica se o e-mail já existe
$sql = "SELECT * FROM usuario WHERE email = '$email'";
$resultado = mysqli_query($conn, $sql);

if(mysqli_num_rows($resultado) > 0){
    die("Este e-mail já está cadastrado.");
}

// Salva o usuário
$sql = "INSERT INTO usuario(nome, email, senha)
VALUES('$nome', '$email', '$senhaHash')";

if(mysqli_query($conn, $sql)){
    echo "Usuário cadastrado com sucesso!";
}else{
    echo "Erro ao cadastrar: " . mysqli_error($conn);
}

mysqli_close($conn);

?>