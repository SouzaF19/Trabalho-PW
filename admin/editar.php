```php
<?php

session_start();

include("../includes/conexao.php");

// Proteção da página
if (!isset($_SESSION["id"])) {
    header("Location: ../index.php");
    exit();
}

// Recebe o ID da carta
$id = $_GET["id"];

// Busca a carta
$sql = "
SELECT
    carta.id,
    carta.id_pokemon,
    carta.id_raridade,
    carta.quantidade
FROM carta
WHERE carta.id = ?
";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$carta = mysqli_fetch_assoc($resultado);

// Busca o nome do Pokémon selecionado
$sqlPokemon = "
SELECT
    nome
FROM pokemon
WHERE id = ?
";

$stmtPokemon = mysqli_prepare($conn, $sqlPokemon);

mysqli_stmt_bind_param(
    $stmtPokemon,
    "i",
    $carta["id_pokemon"]
);

mysqli_stmt_execute($stmtPokemon);

$resultadoPokemon = mysqli_stmt_get_result($stmtPokemon);

$pokemonSelecionado = mysqli_fetch_assoc($resultadoPokemon);

// Busca as raridades
$raridades = mysqli_query(
    $conn,
    "SELECT id, nome FROM raridade ORDER BY nome"
);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Editar Carta</title>

</head>

<body>

<h1>Editar Carta</h1>

<form action="atualizar.php" method="POST">

<input
type="hidden"
name="id"
value="<?php echo $carta["id"]; ?>">

<label>Pokémon:</label>

<br>

<input
type="text"
id="pesquisaPokemon"
value="<?php echo $pokemonSelecionado["nome"]; ?>"
autocomplete="off"
required>

<div id="resultadoPokemon"></div>

<input
type="hidden"
name="id_pokemon"
id="id_pokemon"
value="<?php echo $carta["id_pokemon"]; ?>">

<br><br>

<label>Raridade:</label>

<br>

<select name="id_raridade" required>

<?php while($raridade = mysqli_fetch_assoc($raridades)){ ?>

<option
value="<?php echo $raridade["id"]; ?>"

<?php
if($raridade["id"] == $carta["id_raridade"]){
    echo "selected";
}
?>

>

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
value="<?php echo $carta["quantidade"]; ?>"
required>

<br><br>

<button type="submit">

Salvar Alteração

</button>

</form>

<br>

<a href="admin.php">

Voltar

</a>

<script>

// Pesquisa de Pokémon

let campo = document.getElementById("pesquisaPokemon");

campo.addEventListener("keyup", function(){

    let nome = campo.value;

    if(nome.length < 2){

        document.getElementById("resultadoPokemon").innerHTML = "";

        return;

    }

    // Reutiliza a função fetch para buscar os Pokémon cadastrados no banco de dados, igual pesquisa no Google.
    fetch("../scripts/buscar_pokemon.php?nome=" + nome)

    .then(resposta => resposta.text())

    .then(dados => {

        // Exibe os resultados da pesquisa na div "resultadoPokemon"
        document.getElementById("resultadoPokemon").innerHTML = dados;

    });

});

function escolher(id,nome){

    // Preenche o campo de pesquisa com o nome do Pokémon selecionado
    document.getElementById("pesquisaPokemon").value = nome;

    // Preenche o campo oculto com o ID do Pokémon selecionado
    document.getElementById("id_pokemon").value = id;

    //  Limpa a lista de resultados após o usuário escolher um Pokémon
    document.getElementById("resultadoPokemon").innerHTML = "";

}

</script>

</body>

</html>
```
