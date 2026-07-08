<?php

include("conexao.php");

$pesquisa = "";

if(isset($_GET["pesquisa"])){
    $pesquisa = $_GET["pesquisa"];
}

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

WHERE pokemon.nome LIKE '%$pesquisa%'

ORDER BY pokemon.nome
";

$resultado = mysqli_query($conn, $sql);

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
}

header{
    background:#d32f2f;
    color:white;
    text-align:center;
    padding:20px;
}

.container{
    width:90%;
    margin:30px auto;
}

.topo{
    display:flex;
    justify-content:space-between;
    margin-bottom:20px;
}

input{
    padding:10px;
    width:250px;
}

button{
    padding:10px;
}

.card{

    background:white;

    padding:15px;

    margin-bottom:15px;

    display:flex;

    align-items:center;

    gap:20px;

    border-radius:8px;

}

.card img{

    width:90px;

}

a{

    text-decoration:none;

}

</style>

</head>

<body>

<header>

<h1>Vitrine Pokémon</h1>

</header>

<div class="container">

<div class="topo">

<form>

<input
type="text"
name="pesquisa"
placeholder="Pesquisar Pokémon"
value="<?php echo $pesquisa; ?>">

<button>Pesquisar</button>

</form>

<a href="index.php">

<button>Área do Administrador</button>

</a>

</div>

<?php

if(mysqli_num_rows($resultado)==0){

    echo "<h2>Nenhuma carta cadastrada.</h2>";

}

while($carta=mysqli_fetch_assoc($resultado)){

?>

<div class="card">

<img src="<?= $carta["imagem_url"] ?>">

<div>

<h2><?= $carta["nome"] ?></h2>

<p>Raridade: <?= $carta["raridade"] ?></p>

<p>Quantidade: <?= $carta["quantidade"] ?></p>

</div>

</div>

<?php

}

?>

</div>

</body>

</html>