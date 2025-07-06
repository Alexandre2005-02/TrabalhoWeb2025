<?php
// Inclui o arquivo de conexão com o banco de dados.
include('conexaoBd.php');
// Inicia a sessão para acessar variáveis de sessão.
session_start();

// Verifica se o usuário está logado, se a variável de sessão 'logado' é verdadeira
// e se o tipo de usuário é 'Aprendiz'.
// Se alguma dessas condições não for atendida, redireciona o usuário para a página de índice (index.php) e encerra o script.
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || $_SESSION['tipoUsuario'] !== 'Aprendiz') {
    header('Location: index.php');
    exit();
}

// Verifica se o método da requisição HTTP é POST e se a variável 'idVideo' foi enviada via POST.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idVideo'])) {
    // Coleta o ID do vídeo enviado via POST.
    $idVideo = $_POST['idVideo'];
    // Obtém o ID do usuário da sessão.
    $idUsuario = $_SESSION['idUsuario'];

    // Prepara a query SQL para verificar se o vídeo já foi concluído pelo usuário.
    // Conta o número de registros na tabela 'ConclusaoVideoUsuario' onde o 'idUsuario' e 'idVideo' correspondem.
    $sqlVerificarConclusao = "SELECT COUNT(*) FROM ConclusaoVideoUsuario WHERE idUsuario = ? AND idVideo = ?";
    // Prepara a declaração SQL usando a conexão com o banco de dados.
    $stmtVerificacao = mysqli_prepare($conn, $sqlVerificarConclusao);

    // Verifica se a preparação da declaração de verificação foi bem-sucedida.
    if ($stmtVerificacao) {
        // Vincula os parâmetros à declaração preparada.
        // 'ii' especifica que ambos os parâmetros são inteiros (idUsuario, idVideo).
        mysqli_stmt_bind_param($stmtVerificacao, 'ii', $idUsuario, $idVideo);
        // Executa a declaração preparada.
        mysqli_stmt_execute($stmtVerificacao);
        // Vincula o resultado da consulta à variável $count.
        mysqli_stmt_bind_result($stmtVerificacao, $count);
        // Busca o resultado da consulta.
        mysqli_stmt_fetch($stmtVerificacao);
        // Fecha a declaração de verificação.
        mysqli_stmt_close($stmtVerificacao);

        // Se a contagem for 0, significa que o vídeo ainda não foi concluído pelo usuário.
        if ($count == 0) {
            // Prepara a query SQL para inserir um novo registro na tabela 'ConclusaoVideoUsuario', marcando o vídeo como concluído.
            $sqlInserirConclusao = "INSERT INTO ConclusaoVideoUsuario (idUsuario, idVideo) VALUES (?, ?)";
            // Prepara a declaração SQL para inserção.
            $stmtInsercao = mysqli_prepare($conn, $sqlInserirConclusao);

            // Verifica se a preparação da declaração de inserção foi bem-sucedida.
            if ($stmtInsercao) {
                // Vincula os parâmetros à declaração preparada para inserção.
                mysqli_stmt_bind_param($stmtInsercao, 'ii', $idUsuario, $idVideo);

                // Executa a declaração de inserção.
                if (mysqli_stmt_execute($stmtInsercao)) {
                    // Se a inserção for bem-sucedida, redireciona para 'treinamentos.php' com status 'video_concluido'.
                    header('Location: treinamentos.php?status=video_concluido');
                    exit();
                } else {
                    // Se houver um erro na execução da inserção, redireciona com status 'error_conclusao' e a mensagem de erro do MySQL.
                    header('Location: treinamentos.php?status=error_conclusao&message=' . mysqli_error($conn));
                    exit();
                }
                // Fecha a declaração de inserção.
                mysqli_stmt_close($stmtInsercao);
            } else {
                // Se a preparação da declaração de inserção falhar, redireciona com status 'error_preparacao_insercao' e a mensagem de erro do MySQL.
                header('Location: treinamentos.php?status=error_preparacao_insercao&message=' . mysqli_error($conn));
                exit();
            }
        } else {
            // Se a contagem for maior que 0, significa que o vídeo já foi concluído, então redireciona com status 'video_ja_concluido'.
            header('Location: treinamentos.php?status=video_ja_concluido');
            exit();
        }
    } else {
        // Se a preparação da declaração de verificação falhar, redireciona com status 'error_preparacao_verificacao' e a mensagem de erro do MySQL.
        header('Location: treinamentos.php?status=error_preparacao_verificacao&message=' . mysqli_error($conn));
        exit();
    }
}
// Se o método da requisição não for POST ou se 'idVideo' não estiver definido,
// redireciona para 'treinamentos.php' com status 'requisicao_invalida'.
else {
    header('Location: treinamentos.php?status=requisicao_invalida');
    exit();
}

// Fecha a conexão com o banco de dados.
mysqli_close($conn);
?>