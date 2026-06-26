<?php
session_start();
if (isset($_SESSION["id_usuario"]) && $_SESSION["id_usuario"] !== null) {
    header("Location: main.php");
    exit();
}
