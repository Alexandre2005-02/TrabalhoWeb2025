<?php
// Define o host do banco de dados como 'localhost'.
$host     = "localhost"; // Servidor de BD
// Define o usuário do banco de dados como 'root'.
$user     = "root";     // Usuário do BD
// Define a senha do banco de dados como uma string vazia (comum para instalações padrão do XAMPP/WAMP).
$senhaBD  = "";     // Senha do BD
// Define o nome do banco de dados a ser conectado como 'trabalho'.
$database = "trabalho"; // Nome do BD

// Configura o MySQLi para relatar erros (MYSQLI_REPORT_ERROR) e lançar exceções para erros (MYSQLI_REPORT_STRICT).
// Isso ajuda na depuração, tornando os erros mais visíveis.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Estabelece uma nova conexão com o banco de dados MySQL usando os parâmetros definidos.
// A função mysqli_connect() retorna um objeto de conexão se a conexão for bem-sucedida, ou FALSE em caso de erro.
$conn = mysqli_connect($host, $user, $senhaBD, $database);

// Verifica se a conexão com o banco de dados falhou.
if (!$conn) {
    // Se a conexão falhou, o script é encerrado (die()) e uma mensagem de erro é exibida.
    // A mensagem inclui o nome do banco de dados e detalhes do erro de conexão.
    die("<p>Erro ao tentar conectar à Base de Dados <strong>$database</strong>! Detalhes: " . mysqli_connect_error() . "</p>");
}

// O bloco PHP é fechado aqui. Se a conexão for bem-sucedida, o script continua sem exibir nada,
// e a variável $conn estará disponível para outras partes do código que incluam este arquivo.
?>