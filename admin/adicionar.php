<?php

session_start();

include("../includes/conexao.php");


// Proteção da página
if(!isset($_SESSION["id"])){
    header("Location: ../index.php");
    exit();
}


// Busca os Pokémon cadastrados
$sql_pokemon = "SELECT id, nome FROM pokemon ORDER BY nome";

$resultado_pokemon = mysqli_query($conn, $sql_pokemon);


// Busca as raridades
$sql_raridade = "SELECT id, nome FROM raridade ORDER BY nome";

$resultado_raridade = mysqli_query($conn, $sql_raridade);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Adicionar Carta</title>

</head>

<body>


<h1>Adicionar Carta</h1>


<form action="salvar_carta.php" method="POST">


<label>Pokémon:</label>

<br>

<select name="id_pokemon" required>

<option value="">
Selecione um Pokémon
</option>


<?php while($pokemon = mysqli_fetch_assoc($resultado_pokemon)){ ?>

<option value="<?php echo $pokemon["id"]; ?>">

<?php echo $pokemon["nome"]; ?>

</option>

<?php } ?>


</select>


<br><br>



<label>Raridade:</label>

<br>

<select name="id_raridade" required>


<option value="">
Selecione a raridade
</option>


<?php while($raridade = mysqli_fetch_assoc($resultado_raridade)){ ?>

<option value="<?php echo $raridade["id"]; ?>">

<?php echo $raridade["nome"]; ?>

</option>


<?php } ?>


</select>


<br><br>



<label>Quantidade:</label>

<br>

<input 
type="number"
name="quantidade"
min="1"
value="1"
required>


<br><br>


<button type="submit">

Salvar Carta

</button>


</form>


<br>


<a href="admin.php">

Voltar

</a>


</body>

</html>