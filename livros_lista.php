<?php
session_start();
require_once 'conect.php';

// Segurança: Se não estiver logado, volta para o login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

try {
    // Busca todos os livros e o nome dos autores (usando JOIN)
    $sql = "SELECT l.*, a.nome AS nome_autor 
            FROM livros l 
            LEFT JOIN autores a ON l.id_autor = a.id_autor 
            ORDER BY l.titulo ASC";
    $stmt = $pdo->query($sql);
    $livros = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erro ao listar livros: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Livros - Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="painel.php">📚 Minha Biblioteca</a>
        <a href="painel.php" class="btn btn-outline-light btn-sm">Voltar ao Painel</a>
    </div>
</nav>

<div class="container">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title mb-4">Livros Disponíveis</h2>
            
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>ISBN</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($livros) > 0): ?>
                        <?php foreach ($livros as $livro): ?>
                            <tr>
                                <td><?php echo $livro['titulo']; ?></td>
                                <td><?php echo $livro['nome_autor'] ?? 'Não informado'; ?></td>
                                <td><?php echo $livro['isbn']; ?></td>
                                <td>
                                    <?php if ($livro['disponivel']): ?>
                                        <span class="badge bg-success">Disponível</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Emprestado</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="emprestar.php?id=<?php echo $livro['id_livro']; ?>" 
                                       class="btn btn-sm btn-primary <?php echo !$livro['disponivel'] ? 'disabled' : ''; ?>">
                                       Emprestar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Nenhum livro cadastrado ainda.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>