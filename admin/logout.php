<?php
include("../includes/conexao.php");
session_start();

session_destroy();

header("Location: ../index.php");
exit();

?>