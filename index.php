<?php
include("includes/conexao.php");
session_start();

// Se o admin já estiver logado
if (isset($_SESSION['admin'])) {
    header("Location: /admin/admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Vitrine Pokémon</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{

            background:#f2f2f2;

            display:flex;
            justify-content:center;
            align-items:center;

            height:100vh;

        }

        .login{

            width:350px;
            background:white;

            padding:30px;

            border-radius:10px;

            box-shadow:0 0 10px rgba(0,0,0,.2);

        }

        h1{

            text-align:center;
            margin-bottom:25px;

        }

        label{

            font-weight:bold;

        }

        input{

            width:100%;
            padding:10px;

            margin-top:5px;
            margin-bottom:20px;

        }

        button{

            width:100%;
            padding:10px;

            background:#2ecc71;
            color:white;

            border:none;

            cursor:pointer;

            font-size:16px;

        }

        button:hover{

            background:#27ae60;

        }

        hr{

            margin:25px 0;

        }

        .visitar{

            text-align:center;

        }

        .visitar a{

            text-decoration:none;

            color:#3498db;

            font-weight:bold;

        }

        .visitar a:hover{

            text-decoration:underline;

        }

    </style>

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