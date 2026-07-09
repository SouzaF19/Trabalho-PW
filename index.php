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

<?php
if(isset($_GET["erro"])){
    echo "<p style='color:red;text-align:center;margin-bottom:15px;'>
            Usuário ou senha incorretos.
          </p>";
}
?>

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