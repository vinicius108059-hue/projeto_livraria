<?php
require_once 'conect.php'; // Puxa a conexão com o banco

$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    
    // 1. Criptografia da senha (Segurança)
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        // 2. Prepara o SQL para inserir o usuário
        $sql = "INSERT INTO usuarios (nome, email, login, senha_hash, nivel_acesso) 
                VALUES (:nome, :email, :login, :senha_hash, 'leitor')";
        
        $stmt = $pdo->prepare($sql);
        
        // 3. Vincula os dados com segurança (evita SQL Injection)
        $stmt->execute([
            ':nome'       => $nome,
            ':email'      => $email,
            ':login'      => $login,
            ':senha_hash' => $senha_hash
        ]);

        $mensagem = '<div class="alert alert-success">Cadastro realizado! <a href="index.php">Faça login</a></div>';
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Erro de duplicidade (email ou login já existem)
            $mensagem = '<div class="alert alert-danger">Erro: Login ou E-mail já cadastrado!</div>';
        } else {
            $mensagem = '<div class="alert alert-danger">Erro ao cadastrar: ' . $e->getMessage() . '</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center">Criar Conta</h3>
                    <?php echo $mensagem; ?>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nome Completo</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Usuário (Login)</label>
                            <input type="text" name="login" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" name="senha" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Cadastrar</button>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <a href="index.php">Voltar para o Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>