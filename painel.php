<?php
// 1. Inicia a sessão para verificar se o usuário está logado
session_start();

// 2. Se NÃO existir a variável de sessão, manda de volta para o login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel da Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { height: 100vh; background: #343a40; color: white; padding-top: 20px; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover { background: #495057; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Menu Lateral -->
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="text-center mb-4">
                <h4>Biblioteca</h4>
            </div>
            <a href="painel.php">🏠 Início</a>
            <a href="livros_lista.php">📚 Ver Livros</a>
            
            <?php if ($_SESSION['usuario_nivel'] == 'admin'): ?>
                <a href="cadastrar_livro.php">➕ Cadastrar Livro</a>
                <a href="usuarios_lista.php">👥 Usuários</a>
            <?php endif; ?>
            
            <hr>
            <a href="logout.php" class="text-danger">🚪 Sair</a>
        </nav>

        <!-- Conteúdo Principal -->
        <main class="col-md-10 ms-sm-auto px-md-4 mt-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!</h1>
                <span class="badge bg-info text-dark">Nível: <?php echo $_SESSION['usuario_nivel']; ?></span>
            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Meus Empréstimos</h5>
                            <p class="card-text">Consulte os livros que estão com você.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>