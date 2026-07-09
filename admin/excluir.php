<?php

session_start();

include("../includes/conexao.php");


// Proteção da página

if(!isset($_SESSION["id"])){
    header("Location: ../index.php");
    exit();
}


// Recebe o ID da carta

$id = $_GET["id"];


// Exclui a carta

$sql = "DELETE FROM carta WHERE id = ?";


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


    echo "Erro ao excluir carta: " . mysqli_error($conn);


}


?>