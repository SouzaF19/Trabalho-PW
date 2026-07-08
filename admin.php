<?php

session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit();
}

include("conexao.php");

// Pesquisa
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

<title>Painel do Administrador</title>

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

    padding:20px;

    text-align:center;

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

    padding:10px 15px;

    cursor:pointer;

}

a{

    text-decoration:none;

}

.card{

    background:white;

    margin-bottom:15px;

    padding:15px;

    display:flex;

    align-items:center;

    gap:20px;

    border-radius:8px;

}

.card img{

    width:90px;

}

.acoes{

    margin-left:auto;

}

.acoes a{

    margin-left:10px;

}

</style>

</head>

<body>

<header>

<h1>Painel Administrativo</h1>

<p>Bem-vindo, <?php echo $_SESSION["nome"]; ?></p>

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

<div>

<a href="adicionar.php">

<button>+ Adicionar Carta</button>

</a>

<a href="vitrine.php">

<button>Ver Vitrine</button>

</a>

<a href="logout.php">

<button>Sair</button>

</a>

</div>

</div>

<?php

if(mysqli_num_rows($resultado) == 0){

    echo "<h3>Nenhuma carta cadastrada.</h3>";

}

while($carta = mysqli_fetch_assoc($resultado)){

?>

<div class="card">

<img src="<?= $carta["imagem_url"] ?>">

<div>

<h2><?= $carta["nome"] ?></h2>

<p>Raridade: <?= $carta["raridade"] ?></p>

<p>Quantidade: <?= $carta["quantidade"] ?></p>

</div>

<div class="acoes">

<a href="editar.php?id=<?= $carta["id"] ?>">

<button>Editar</button>

</a>

<a href="excluir.php?id=<?= $carta["id"] ?>">

<button>Excluir</button>

</a>

</div>

</div>

<?php

}

?>

</div>

</body>

</html>