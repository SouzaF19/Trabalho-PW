<?php

session_start();

session_destroy();

// Redireciona o usuário para a página de login após o logout
header("Location: ../index.php");
exit();

?>