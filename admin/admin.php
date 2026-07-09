<?php

session_start();

include("../includes/conexao.php");


// Proteção da página
if(!isset($_SESSION["id"])){
    header("Location: ../index.php");
    exit();
}


// Busca as cartas cadastradas
$sql = "

SELECT
carta.id,
pokemon.nome,
pokemon.imagem_url,
raridade.nome AS raridade,
carta.quantidade

FROM carta

INNER JOIN pokemon
ON carta.id_pokemon = pokemon.id

INNER JOIN raridade
ON carta.id_raridade = raridade.id

ORDER BY pokemon.nome

";


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


<h2>Gerenciar Cartas</h2>

<a href="adicionar.php">
    <button>
        Adicionar Carta
    </button>
</a>



<hr>


<h2>Cartas cadastradas</h2>


<table border="1">

<th>ID</th>
<th>Pokémon</th>
<th>Imagem</th>
<th>Raridade</th>
<th>Quantidade</th>
<th>Ações</th>


<?php while($carta = mysqli_fetch_assoc($resultado)){ ?>

<tr>

    <td>
        <?php echo $carta["id"]; ?>
    </td>

    <td>
        <?php echo $carta["nome"]; ?>
    </td>

    <td>
        <img src="<?php echo $carta["imagem_url"]; ?>" width="80">
    </td>

    <td>
        <?php echo $carta["raridade"]; ?>
    </td>

    <td>
        <?php echo $carta["quantidade"]; ?>
    </td>

    <td>

    <a href="editar.php?id=<?php echo $carta["id"]; ?>">
        Editar
    </a>
    <br>
    <a href="excluir.php?id=<?php echo $carta["id"]; ?>"
    onclick="return confirm('Deseja excluir esta carta?');">

        Excluir
    </a>

</td>

</tr>

<?php } ?>


</table>


</body>

</html>