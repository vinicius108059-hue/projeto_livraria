<?php
// Inicia a sessão
session_start();

// Importa a conexão
require_once 'conect.php';

// Verifica se os dados vieram via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_digitado = $_POST['login'];
    $senha_digitada = $_POST['senha'];

    try {
        // Busca o usuário no banco pelo login
        $sql = "SELECT id_usuario, nome, senha_hash, nivel_acesso FROM usuarios WHERE login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':login' => $login_digitado]);
        $usuario = $stmt->fetch();

        // Se o usuário existir
        if ($usuario) {
            // Verifica se a senha digitada combina com o hash do banco
            if (password_verify($senha_digitada, $usuario['senha_hash'])) {
                
                // LOGIN COM SUCESSO: Salva os dados na sessão
                $_SESSION['usuario_id']   = $usuario['id_usuario'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_nivel']= $usuario['nivel_acesso'];

                // Redireciona para o painel principal
                header("Location: painel.php");
                exit;
            }
        }

        // Se chegou aqui, é porque o login ou a senha estão errados
        header("Location: index.php?erro=1");
        exit;

    } catch (PDOException $e) {
        die("Erro no sistema: " . $e->getMessage());
    }
} else {
    // Se tentarem acessar o arquivo direto, manda de volta para o index
    header("Location: index.php");
    exit;
}