<?php

session_start();

include("../includes/conexao.php");


// Proteção da página
if(!isset($_SESSION["id"])){
    header("Location: ../index.php");
    exit();
}


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

<option value="">
Selecione um Pokémon
</option>

<label>Pokémon:</label>

<br>

<input 
type="text"
id="pesquisaPokemon"
placeholder="Digite o nome do Pokémon"
autocomplete="off"
required>


<div id="resultadoPokemon"></div>


<input 
type="hidden"
name="id_pokemon"
id="id_pokemon">


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



<script>
    //Script usado para buscar os Pokémon cadastrados no banco de dados, igual pesquisa no Google.

let campo = document.getElementById("pesquisaPokemon");


campo.addEventListener("keyup", function(){


    let nome = campo.value;

    // O usuário deve buscar pelo menos 2 caracteres para que a pesquisa seja realizada
    if(nome.length < 2){

        document.getElementById("resultadoPokemon").innerHTML = "";

        return;

    }


    fetch("../scripts/buscar_pokemon.php?nome=" + nome)


    .then(resposta => resposta.text())


    .then(dados => {

        document.getElementById("resultadoPokemon").innerHTML = dados;

    });


});



function escolher(id,nome){


    document.getElementById("pesquisaPokemon").value = nome;


    document.getElementById("id_pokemon").value = id;


    document.getElementById("resultadoPokemon").innerHTML = "";


}


</script>

</body>

</html>