<?php

// Inclui o arquivo de conexão com o banco de dados.
include("conexaoBd.php");
// Inicia a sessão para acessar variáveis de sessão.
session_start();

// Verifica se os campos 'emailUsuario' e 'senhaUsuario' não estão vazios no POST.
if (!empty($_POST['emailUsuario']) && !empty($_POST['senhaUsuario'])) {
    // Coleta o email e a senha do usuário enviados via POST.
    $emailUsuario = $_POST['emailUsuario'];
    $senhaUsuario = $_POST['senhaUsuario'];

    // Prepara a query SQL para buscar o usuário pelo email.
    // O '?' é um placeholder para prevenir SQL Injection.
    $buscarLogin = "SELECT * FROM Usuarios WHERE emailUsuario = ?";

    // Prepara a declaração SQL usando a conexão com o banco de dados.
    $stmt = mysqli_prepare($conn, $buscarLogin);

    // Verifica se a preparação da declaração foi bem-sucedida.
    if ($stmt) {
        // Vincula o parâmetro (email do usuário) à declaração preparada.
        // 's' indica que o parâmetro é uma string.
        mysqli_stmt_bind_param($stmt, 's', $emailUsuario);
        
        // Executa a declaração preparada.
        mysqli_stmt_execute($stmt);
        
        // Obtém o resultado da execução da declaração.
        $resultado = mysqli_stmt_get_result($stmt);

        // Verifica se encontrou um registro para o email fornecido.
        if ($registro = mysqli_fetch_assoc($resultado)) {
            // Verifica se a senha fornecida corresponde à senha hash armazenada no banco de dados.
            // 'password_verify' é uma função segura para comparar senhas com hashes.
            if (password_verify($senhaUsuario, $registro['senhaUsuario'])) {
                // Se as credenciais estiverem corretas, define as variáveis de sessão.
                $_SESSION['idUsuario']    = $registro['idUsuario'];
                $_SESSION['tipoUsuario']  = $registro['tipoUsuario'];
                $_SESSION['emailUsuario'] = $registro['emailUsuario'];
                $_SESSION['nomeUsuario']  = $registro['nomeUsuario'];
                $_SESSION['logado']       = true; // Define o status de login como verdadeiro.

                // Redireciona o usuário para a página inicial (index.php).
                header('location:index.php?pagina=index');
                exit(); // Encerra o script após o redirecionamento.
            } else {
                // Se a senha estiver incorreta, redireciona para a página de login com um erro de 'senhaInvalida'.
                header('location:fazerLogin.php?erroLogin=senhaInvalida');
                exit(); // Encerra o script.
            }
        } else {
            // Se nenhum registro for encontrado para o email, redireciona com um erro de 'dadosInvalidos'.
            header('location:fazerLogin.php?erroLogin=dadosInvalidos');
            exit(); // Encerra o script.
        }
        
        // Fecha a declaração.
        mysqli_stmt_close($stmt);

    } 
    else {
        // Se a preparação da declaração falhar, redireciona com um erro interno.
        header('location:fazerLogin.php?erroLogin=erroInterno');
        exit(); // Encerra o script.
    }
} 
else {
    // Se os campos de email ou senha estiverem vazios, redireciona com um erro de 'dadosInvalidos'.
    header('location:fazerLogin.php?erroLogin=dadosInvalidos');
    exit(); // Encerra o script.
}
?>