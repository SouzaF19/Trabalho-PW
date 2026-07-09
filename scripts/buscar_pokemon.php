<?php

include("conexao.php");

$nome = $_GET["nome"];

$sql = "

SELECT *

FROM pokemon

WHERE nome LIKE '%$nome%'

ORDER BY nome

LIMIT 10

";

$resultado = mysqli_query($conn,$sql);

while($pokemon=mysqli_fetch_assoc($resultado)){

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