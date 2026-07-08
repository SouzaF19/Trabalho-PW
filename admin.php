<?php

session_start();

include("conexao.php");


// Proteção da página
if(!isset($_SESSION["id"])){
    header("Location: index.php");
    exit();
}


// Busca os Pokémon
$sql = "SELECT * FROM pokemon ORDER BY numero_pokedex ASC";

$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel Admin</title>
</head>

<body>

<h1>Painel Administrativo</h1>

<p>
    Bem-vindo, <?php echo $_SESSION["nome"]; ?>
</p>


<h2>Cadastrar Pokémon</h2>

<form action="salvar.php" method="POST">

    <label>ID:</label>
    <input type="number" name="id" required>

    <br>

    <label>Nome:</label>
    <input type="text" name="nome" required>

    <br>

    <label>Número Pokedex:</label>
    <input type="number" name="numero_pokedex" required>

    <br>

    <label>Tipo:</label>
    <input type="text" name="tipo">

    <br>

    <label>Imagem URL:</label>
    <input type="text" name="imagem_url">

    <br>

    <label>Descrição:</label>
    <textarea name="descricao"></textarea>

    <br>

    <button type="submit">
        Salvar Pokémon
    </button>

</form>


<hr>


<h2>Pokémon cadastrados</h2>


<table border="1">

<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Número</th>
    <th>Tipo</th>
    <th>Imagem</th>
    <th>Descrição</th>
</tr>


<?php while($pokemon = mysqli_fetch_assoc($resultado)){ ?>

<tr>

    <td>
        <?php echo $pokemon["id"]; ?>
    </td>

    <td>
        <?php echo $pokemon["nome"]; ?>
    </td>

    <td>
        <?php echo $pokemon["numero_pokedex"]; ?>
    </td>

    <td>
        <?php echo $pokemon["tipo"]; ?>
    </td>

    <td>
        <img src="<?php echo $pokemon["imagem_url"]; ?>" width="80">
    </td>

    <td>
        <?php echo $pokemon["descricao"]; ?>
    </td>

</tr>

<?php } ?>


</table>


</body>

</html>