<?php
// Inicia a sessão PHP. Se a sessão já estiver iniciada, esta função não fará nada.
// É crucial chamar session_start() no início de cada script que precise acessar ou manipular variáveis de sessão.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?><!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brigadista Virtual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-5">
        <a class="navbar-brand" href="index.php">Brigadista Virtual</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="sobre.php">Sobre</a></li>

                <?php
                // Verifica se o usuário está logado.
                if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
                    // Links visíveis apenas para usuários logados.
                    echo '<li class="nav-item"><a class="nav-link" href="treinamentos.php">Treinamentos</a></li>';
                    
                    // Link visível apenas para usuários do tipo 'Aprendiz'.
                    if (isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] === 'Aprendiz') {
                        echo '<li class="nav-item"><a class="nav-link" href="meusCertificados.php">Meus Certificados</a></li>';
                    }
                    
                    // Links visíveis apenas para usuários do tipo 'Tutor'.
                    if (isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] === 'Tutor') {
                        echo '<li class="nav-item"><a class="nav-link" href="adicionarVideo.php">Adicionar Vídeo</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="gerenciarCertificados.php">Gerenciar Certificados</a></li>';
                    }

                    // Link de Logout, visível para todos os usuários logados.
                    echo '
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger" href="fazerLogout.php">
                            Sair <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </li>';
                } 
                else {
                    // Link de Login, visível apenas para usuários não logados.
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="fazerLogin.php">Login</a>
                    </li>
                    ';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>