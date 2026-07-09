<?php

include("../includes/conexao.php");


$nome = $_GET["nome"] ?? "";


$sql = "

SELECT *

FROM pokemon

WHERE nome LIKE ?

ORDER BY nome

LIMIT 10

";


$stmt = mysqli_prepare($conn, $sql);


$pesquisa = "%" . $nome . "%";


mysqli_stmt_bind_param(
    $stmt,
    "s",
    $pesquisa
);


mysqli_stmt_execute($stmt);


$resultado = mysqli_stmt_get_result($stmt);



while($pokemon = mysqli_fetch_assoc($resultado)){

?>

<div
class="item"

onclick="escolher(
<?= $pokemon["id"] ?>,
'<?= $pokemon["nome"] ?>'
)">

<?= $pokemon["nome"] ?>

</div>


<?php

}

?>