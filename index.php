<?php
// Iniciamos a sessão para poder salvar quem logou
session_start();

// Se o usuário já estiver logado, manda ele direto para o painel principal
if (isset($_SESSION['usuario_id'])) {
    header("Location: painel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca Digital</title>
    <!-- Bootstrap para um visual moderno -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { max-width: 400px; margin-top: 100px; }
    </style>
</head>
<body>

<div class="container login-container">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="text-center mb-4">📚 Login Biblioteca</h3>
            
            <?php 
            // Exibe mensagem de erro caso o login falhe
            if (isset($_GET['erro'])) {
                echo '<div class="alert alert-danger">Login ou senha inválidos!</div>';
            }
            ?>

            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="login" class="form-label">Usuário (Login)</label>
                    <input type="text" name="login" id="login" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
            
            <div class="mt-3 text-center">
                <small>Ainda não tem conta? <a href="cadastro.php">Cadastre-se aqui</a></small>
            </div>
        </div>
    </div>
</div>

</body>
</html>