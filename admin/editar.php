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

// Busca Pokémon
$pokemons = mysqli_query(
    $conn,
    "SELECT id, nome FROM pokemon ORDER BY nome"
);

// Busca raridades
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
            value="<?php echo $carta["id"]; ?>"
        >

        <label>Pokémon:</label>

        <br>

        <select name="id_pokemon">

            <?php while ($pokemon = mysqli_fetch_assoc($pokemons)) { ?>

                <option
                    value="<?php echo $pokemon["id"]; ?>"

                    <?php
                    if ($pokemon["id"] == $carta["id_pokemon"]) {
                        echo "selected";
                    }
                    ?>
                >
                    <?php echo $pokemon["nome"]; ?>
                </option>

            <?php } ?>

        </select>

        <br><br>

        <label>Raridade:</label>

        <br>

        <select name="id_raridade">

            <?php while ($raridade = mysqli_fetch_assoc($raridades)) { ?>

                <option
                    value="<?php echo $raridade["id"]; ?>"

                    <?php
                    if ($raridade["id"] == $carta["id_raridade"]) {
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
            value="<?php echo $carta["quantidade"]; ?>"
            min="1"
        >

        <br><br>

        <button type="submit">
            Salvar Alteração
        </button>

    </form>

    <br>

    <a href="admin.php">
        Voltar
    </a>

</body>

</html>