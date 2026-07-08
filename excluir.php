<?php

session_start();

include("conexao.php");


// Verifica login
if(!isset($_SESSION["id"])){
    header("Location: index.php");
    exit();
}


// Recebe o ID
$id = $_GET["id"];


// Exclui o Pokémon
$sql = "DELETE FROM pokemon WHERE id = ?";


$stmt = mysqli_prepare($conn, $sql);


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);


if(mysqli_stmt_execute($stmt)){

    header("Location: admin.php?excluido=1");
    exit();

}else{

    echo "Erro ao excluir: " . mysqli_error($conn);

}

?>