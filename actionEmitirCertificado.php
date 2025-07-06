<?php
// Define o fuso horário padrão para 'America/Sao_Paulo'.
date_default_timezone_set('America/Sao_Paulo');
// Inclui o arquivo de conexão com o banco de dados.
include('conexaoBd.php');
// Inicia a sessão para acessar variáveis de sessão.
session_start();

// Verifica se o usuário está logado, se a variável de sessão 'logado' é verdadeira
// e se o tipo de usuário é 'Tutor'. Se alguma dessas condições não for atendida,
// redireciona o usuário para a página de índice (index.php) e encerra o script.
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || $_SESSION['tipoUsuario'] !== 'Tutor') {
    header('Location: index.php');
    exit();
}

// Verifica se o método da requisição HTTP é POST e se as variáveis 'idAprendiz' e 'idVideo' foram enviadas via POST.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idAprendiz']) && isset($_POST['idVideo'])) {
    // Coleta o ID do aprendiz e o ID do vídeo (treinamento) enviados via POST.
    $idAprendiz = $_POST['idAprendiz'];
    $idVideo = $_POST['idVideo']; // Renomeado para idTreinamento na tabela, mas aqui ainda é idVideo do POST.
    // Obtém o ID do tutor emissor da sessão.
    $idTutorEmissor = $_SESSION['idUsuario'];

    // Gera um código de certificado único usando 'CERT_' e 8 bytes aleatórios convertidos para hexadecimal.
    $codigoCertificado = 'CERT_' . strtoupper(bin2hex(random_bytes(8)));

    // Prepara a query SQL para verificar se já existe um certificado para este aprendiz e treinamento.
    $sqlVerificarCertificado = "SELECT COUNT(*) FROM Certificados WHERE idUsuario = ? AND idTreinamento = ?";
    // Prepara a declaração SQL usando a conexão com o banco de dados.
    $stmtVerificarCertificado = mysqli_prepare($conn, $sqlVerificarCertificado);

    // Verifica se a preparação da declaração de verificação foi bem-sucedida.
    if ($stmtVerificarCertificado) {
        // Vincula os parâmetros à declaração preparada.
        // 'ii' especifica que ambos os parâmetros são inteiros (idAprendiz, idVideo/idTreinamento).
        mysqli_stmt_bind_param($stmtVerificarCertificado, 'ii', $idAprendiz, $idVideo);
        // Executa a declaração preparada.
        mysqli_stmt_execute($stmtVerificarCertificado);
        // Vincula o resultado da consulta à variável $count.
        mysqli_stmt_bind_result($stmtVerificarCertificado, $count);
        // Busca o resultado da consulta.
        mysqli_stmt_fetch($stmtVerificarCertificado);
        // Fecha a declaração de verificação.
        mysqli_stmt_close($stmtVerificarCertificado);

        // Se a contagem for maior que 0, significa que já existe um certificado para este aprendiz e treinamento.
        if ($count > 0) {
            // Redireciona para 'gerenciarCertificados.php' com um status de erro e uma mensagem.
            header('Location: gerenciarCertificados.php?status=error_certificado_existente&message=Este aprendiz já possui um certificado para este treinamento.');
            exit();
        }
    } else {
        // Se a preparação da declaração de verificação falhar, redireciona com status de erro e a mensagem de erro do MySQL.
        header('Location: gerenciarCertificados.php?status=error_preparacao_verificacao_cert&message=' . mysqli_error($conn));
        exit();
    }

    // Prepara a query SQL para inserir um novo certificado na tabela 'Certificados'.
    $sqlInserirCertificado = "INSERT INTO Certificados (idUsuario, idTreinamento, idTutorEmissor, codigoCertificado) VALUES (?, ?, ?, ?)";
    // Prepara a declaração SQL para inserção.
    $stmtInsercao = mysqli_prepare($conn, $sqlInserirCertificado);

    // Verifica se a preparação da declaração de inserção foi bem-sucedida.
    if ($stmtInsercao) {
        // Vincula os parâmetros à declaração preparada para inserção.
        // 'iiis' especifica os tipos de dados: 'i' para idUsuario, 'i' para idTreinamento,
        // 'i' para idTutorEmissor, 's' para codigoCertificado (string).
        mysqli_stmt_bind_param($stmtInsercao, 'iiis', $idAprendiz, $idVideo, $idTutorEmissor, $codigoCertificado);

        // Executa a declaração de inserção.
        if (mysqli_stmt_execute($stmtInsercao)) {
            // Se a execução for bem-sucedida, redireciona para 'gerenciarCertificados.php' com status 'certificado_emitido'.
            header('Location: gerenciarCertificados.php?status=certificado_emitido');
            exit();
        } else {
            // Se houver um erro na execução da inserção, redireciona com status de erro e a mensagem de erro do MySQL.
            header('Location: gerenciarCertificados.php?status=error_emissao&message=' . mysqli_error($conn));
            exit();
        }
        // Fecha a declaração de inserção.
        mysqli_stmt_close($stmtInsercao);
    } else {
        // Se a preparação da declaração de inserção falhar, redireciona com status de erro e a mensagem de erro do MySQL.
        header('Location: gerenciarCertificados.php?status=error_preparacao_emissao&message=' . mysqli_error($conn));
        exit();
    }
}
// Se o método da requisição não for POST ou se 'idAprendiz' ou 'idVideo' não estiverem definidos,
// redireciona para 'gerenciarCertificados.php' com status 'requisicao_invalida'.
else {
    header('Location: gerenciarCertificados.php?status=requisicao_invalida');
    exit();
}

// Fecha a conexão com o banco de dados.
mysqli_close($conn);
?>