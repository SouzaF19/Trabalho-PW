<?php
include("includes/conexao.php");
session_start();

// Se o admin já estiver logado
if (isset($_SESSION['admin'])) {
    header("Location: admin/admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Vitrine Pokémon</title>

    <link rel="stylesheet" href="css/login.css">

</head>


<body>

<div class="login">

    <h1>Vitrine Pokémon</h1>

    <form action="auth/login.php" method="POST">

        <label>Usuário</label>

        <input
        type="text"
        name="usuario"
        required>

        <label>Senha</label>

        <input
        type="password"
        name="senha"
        required>

        <button type="submit">
            Entrar
        </button>

        <?php

    // Caso haja erro de login
    if(isset($_GET["erro"])){

    echo "<p class='erro'>
        Usuário ou senha incorretos. </p>";

    }

?>

    </form>

    <hr>

    <div class="visitar">

        <a href="pages/vitrine.php">
            Apenas visualizar
        </a>

    </div>

</div>

</body>

</html>