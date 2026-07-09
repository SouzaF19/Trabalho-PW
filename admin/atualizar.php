<?php

session_start();

include("../includes/conexao.php");


// Proteção da página
if(!isset($_SESSION["id"])){
    header("Location: ../index.php");
    exit();
}


// Recebe os dados

$id = $_POST["id"];
$id_pokemon = $_POST["id_pokemon"];
$id_raridade = $_POST["id_raridade"];
$quantidade = $_POST["quantidade"];


// Atualiza a carta

$sql = "

UPDATE carta

SET 
id_pokemon = ?,
id_raridade = ?,
quantidade = ?

WHERE id = ?

";


$stmt = mysqli_prepare($conn, $sql);


mysqli_stmt_bind_param(
    $stmt,
    "iiii",
    $id_pokemon,
    $id_raridade,
    $quantidade,
    $id
);



if(mysqli_stmt_execute($stmt)){


    header("Location: admin.php?editado=1");
    exit();


}else{


    echo "Erro ao atualizar carta: " . mysqli_error($conn);


}


?>