<?php
// Define o fuso horário padrão para 'America/Sao_Paulo'.
date_default_timezone_set('America/Sao_Paulo');

// Inclui o cabeçalho da página (contém a tag <html>, <head>, e o início do <body>, além da barra de navegação).
include('header.php');
// Inclui o arquivo de conexão com o banco de dados.
include('conexaoBd.php');

// Verifica se o usuário está logado, se a variável de sessão 'logado' é verdadeira
// e se o tipo de usuário é 'Aprendiz'. Se alguma dessas condições não for atendida,
// o usuário é redirecionado para a página de índice (index.php) e o script é encerrado.
// Esta é uma medida de segurança para garantir que apenas aprendizes logados possam acessar esta página.
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || $_SESSION['tipoUsuario'] !== 'Aprendiz') {
    header('Location: index.php');
    exit();
}

// Obtém o ID do usuário logado da sessão. Este ID será usado para buscar os certificados específicos do aprendiz.
$idUsuario = $_SESSION['idUsuario'];
?>

<header class="bg-danger bg-gradient text-white">
    <div class="container px-10 text-center py-5">
        <h1 class="fw-bolder">Meus Certificados</h1>
        <p class="lead">Visualize e gerencie seus certificados de treinamento.</p>
    </div>
</header>

<section class="py-5 bg-dark text-white">
    <div class="container px-5">
        <h2 class="text-center mb-5">Meus Certificados Emitidos</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php
            // Query SQL para buscar os certificados do usuário logado.
            // A consulta une as tabelas Certificados, VideosTreinamento e Usuarios para obter todos os detalhes necessários.
            $sqlBuscarCertificados = "SELECT c.codigoCertificado, vt.tituloVideo, vt.descricaoVideo, c.dataEmissao,
                                      u.nomeUsuario AS nomeTutor, u.emailUsuario AS emailTutor
                                      FROM Certificados c
                                      JOIN VideosTreinamento vt ON c.idTreinamento = vt.idVideo
                                      JOIN Usuarios u ON c.idTutorEmissor = u.idUsuario
                                      WHERE c.idUsuario = ?
                                      ORDER BY c.dataEmissao DESC"; // Ordena os certificados pela data de emissão mais recente.

            // Prepara a declaração SQL para prevenir SQL Injection.
            $stmtCertificados = mysqli_prepare($conn, $sqlBuscarCertificados);

            // Verifica se a preparação da declaração foi bem-sucedida.
            if ($stmtCertificados) {
                // Vincula o ID do usuário logado ao placeholder na consulta. 'i' indica que é um inteiro.
                mysqli_stmt_bind_param($stmtCertificados, 'i', $idUsuario);
                // Executa a declaração preparada.
                mysqli_stmt_execute($stmtCertificados);
                // Obtém o resultado da execução da declaração.
                $resultadoCertificados = mysqli_stmt_get_result($stmtCertificados);

                // Verifica se há certificados para o usuário.
                if (mysqli_num_rows($resultadoCertificados) > 0) {
                    // Itera sobre cada certificado encontrado.
                    while ($certificado = mysqli_fetch_assoc($resultadoCertificados)) {
                        // Limpa e armazena os dados do certificado.
                        $codigoCertificado = htmlspecialchars($certificado['codigoCertificado'] ?? 'N/A');
                        $tituloVideo = htmlspecialchars($certificado['tituloVideo'] ?? 'Título Indisponível');
                        $descricaoVideo = htmlspecialchars($certificado['descricaoVideo'] ?? 'Descrição Indisponível');
                        // Cria um objeto DateTime para formatar a data de emissão para exibição amigável.
                        $dataEmissao = new DateTime(htmlspecialchars($certificado['dataEmissao'] ?? ''));
                        $dataEmissaoFormatada = $dataEmissao->format('d/m/Y H:i');
                        $nomeTutor = htmlspecialchars($certificado['nomeTutor'] ?? 'N/A');

                        // Exibe um card para cada certificado.
                        echo '
                        <div class="col">
                            <div class="card h-100 bg-secondary text-white shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-certificate me-2"></i>' . $tituloVideo . '</h5>
                                    <p class="card-text"><strong>Emitido em:</strong> ' . $dataEmissaoFormatada . '</p>
                                    <p class="card-text"><strong>Por:</strong> ' . $nomeTutor . '</p>
                                    <p class=\"card-text\"><small class=\"text-muted\">Código: ' . $codigoCertificado . '</small></p>
                                    <a href="visualizarCertificado.php?codigo=' . $codigoCertificado . '" target="_blank" class="btn btn-primary w-100 mt-3">
                                        <i class="fas fa-eye me-2"></i>Visualizar Certificado
                                    </a>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    // Mensagem exibida se o usuário não possui certificados.
                    echo '<div class="col-12 text-center">
                            <p class="lead">Você ainda não possui nenhum certificado emitido.</p>
                          </div>';
                }
                // Fecha a declaração preparada.
                mysqli_stmt_close($stmtCertificados);
            } else {
                // Mensagem de erro se a preparação da consulta falhar.
                echo '<div class="col-12 text-center text-danger">
                        <p class="lead">Erro ao preparar a consulta de certificados.</p>
                      </div>';
            }
            // Fecha a conexão com o banco de dados.
            mysqli_close($conn);
            ?>
        </div>
    </div>
</section>

<?php
// Inclui o rodapé da página.
include('footer.php');
?>