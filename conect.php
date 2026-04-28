<?php
// Configurações do banco de dados
$host = 'localhost';
$db   = 'projeto_biblioteca'; // Certifique-se que este é o nome que você deu ao DB
$user = 'root';               // Usuário padrão do XAMPP/WAMP
$pass = '';                   // Senha padrão (geralmente vazia no XAMPP)
$charset = 'utf8mb4';

// Configuração do DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opções do PDO para segurança e tratamento de erros
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lança exceções em caso de erro
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna os dados como array associativo
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desativa a emulação para maior segurança
];

try {
    // Tenta estabelecer a conexão
    $pdo = new PDO($dsn, $user, $pass, $options);
    // echo "Conectado com sucesso!"; // Descomente para testar
} catch (\PDOException $e) {
    // Se houver erro, ele será exibido aqui
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}
?>