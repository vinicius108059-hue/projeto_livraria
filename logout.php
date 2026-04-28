<?php
session_start(); // Inicia a sessão para saber quem deslogar
session_unset(); // Remove todas as variáveis da sessão
session_destroy(); // Destrói a sessão completamente

// Redireciona o usuário de volta para a tela de login
header("Location: index.php");
exit;
?>