<?php
// Define o fuso horário padrão para 'America/Sao_Paulo'.
date_default_timezone_set('America/Sao_Paulo');

// Inclui o cabeçalho da página (geralmente contém HTML, CSS e scripts comuns).
include('header.php');
// Inclui o arquivo de conexão com o banco de dados.
include('conexaoBd.php');

// Verifica se o usuário está logado, se a variável de sessão 'logado' é verdadeira
// e se o tipo de usuário é 'Tutor'. Se alguma dessas condições não for atendida,
// o usuário é redirecionado para a página de índice (index.php) e o script é encerrado.
// Esta é uma medida de segurança para garantir que apenas tutores logados possam acessar esta página.
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || $_SESSION['tipoUsuario'] !== 'Tutor') {
    header('Location: index.php');
    exit();
}

// Inicializa a variável $termoBusca para armazenar o termo de busca do usuário.
$termoBusca = '';
// Verifica se o parâmetro 'busca' foi enviado via GET e se não está vazio.
if (isset($_GET['busca']) && !empty($_GET['busca'])) {
    // Limpa o termo de busca para prevenir ataques XSS (Cross-Site Scripting) e remove espaços em branco.
    $termoBusca = htmlspecialchars(trim($_GET['busca']));
}
?>

<header class="bg-danger bg-gradient text-white">
    <div class="container px-10 text-center py-5">
        <h1 class="fw-bolder">Gerenciar Certificados</h1>
        <p class="lead">Visualize o progresso dos aprendizes e emita certificados.</p>
    </div>
</header>

<section class="py-5 bg-dark text-white">
    <div class="container px-5">
        <h2 class="text-center mb-5">Progresso dos Aprendizes</h2>

        <?php
        // Bloco PHP para exibir mensagens de status com base nos parâmetros da URL.
        if (isset($_GET['status'])) {
            // Obtém a data e hora atual no formato 'dd/mm/AAAA HH:ii'.
            $dataHoraAtual = date('d/m/Y H:i');
            $local = "Brasil"; // Define a localização.

            // Mensagem para certificado emitido com sucesso.
            if ($_GET['status'] == 'certificado_emitido') {
                echo '<div class="alert alert-success text-center">Certificado emitido com sucesso! <br> <small>(' . $dataHoraAtual . ' - ' . $local . ')</small></div>';
            } // Mensagem para vídeo marcado como concluído.
            elseif ($_GET['status'] == 'video_concluido') { 
                echo '<div class="alert alert-success text-center">Vídeo marcado como concluído com sucesso! <br> <small>(' . $dataHoraAtual . ' - ' . $local . ')</small></div>';
            } // Mensagem para vídeo que já foi marcado como concluído.
            elseif ($_GET['status'] == 'video_ja_concluido') {
                echo '<div class="alert alert-warning text-center">Este vídeo já foi marcado como concluído por este usuário.</div>';
            } // Mensagens de erro gerais (se o status contiver 'error').
            elseif (strpos($_GET['status'], 'error') !== false) {
                // Pega a mensagem de erro da URL ou define uma mensagem padrão.
                $mensagemErro = htmlspecialchars($_GET['message'] ?? 'Ocorreu um erro.');
                echo '<div class="alert alert-danger text-center">Erro: ' . $mensagemErro . '</div>';
            } // Mensagem para requisição inválida.
            elseif ($_GET['status'] == 'requisicao_invalida') {
                echo '<div class="alert alert-warning text-center">Requisição inválida.</div>';
            } // Mensagem para certificado já existente.
            elseif ($_GET['status'] == 'error_certificado_existente') { 
                // Pega a mensagem de erro da URL ou define uma mensagem padrão.
                $mensagemErro = htmlspecialchars($_GET['message'] ?? 'O certificado já existe.');
                echo '<div class="alert alert-warning text-center">Atenção: ' . $mensagemErro . '</div>';
            }
        }
        ?>

        <div class="row mb-4">
            <div class="col-md-6 offset-md-3">
                <form action="gerenciarCertificados.php" method="GET" class="d-flex flex-column">
                    <label for="campoBuscaAprendiz" class="form-label text-white mb-2">Insira o nome do aprendiz:</label>
                    <div class="d-flex">
                        <input type="text" class="form-control me-2 bg-secondary text-white border-secondary" id="campoBuscaAprendiz" placeholder="Buscar..." name="busca" value="<?php echo $termoBusca; ?>">
                        <button type="submit" class="btn btn-danger">Buscar</button>
                        <?php
                        // Exibe o botão "Limpar" se houver um termo de busca.
                        if (!empty($termoBusca)): ?>
                            <a href="gerenciarCertificados.php" class="btn btn-outline-secondary ms-2">Limpar</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php
                // Query SQL para buscar aprendizes.
                $sqlBuscarAprendizes = "SELECT idUsuario, nomeUsuario, emailUsuario FROM Usuarios WHERE tipoUsuario = 'Aprendiz'";
                // Adiciona a condição de busca se um termo for fornecido.
                if (!empty($termoBusca)) {
                    $sqlBuscarAprendizes .= " AND nomeUsuario LIKE ?";
                }
                // Ordena os resultados pelo nome do aprendiz.
                $sqlBuscarAprendizes .= " ORDER BY nomeUsuario ASC";

                // Prepara a declaração SQL para buscar aprendizes.
                $stmtAprendizes = mysqli_prepare($conn, $sqlBuscarAprendizes);

                // Verifica se a preparação da declaração foi bem-sucedida.
                if ($stmtAprendizes) {
                    // Se houver um termo de busca, vincula o parâmetro à declaração.
                    if (!empty($termoBusca)) {
                        $paramBusca = '%' . $termoBusca . '%'; // Adiciona curingas para busca parcial.
                        mysqli_stmt_bind_param($stmtAprendizes, 's', $paramBusca);
                    }
                    // Executa a declaração.
                    mysqli_stmt_execute($stmtAprendizes);
                    // Obtém o resultado da execução.
                    $resultadoAprendizes = mysqli_stmt_get_result($stmtAprendizes);

                    // Verifica se encontrou aprendizes.
                    if (mysqli_num_rows($resultadoAprendizes) > 0) {
                        // Itera sobre cada aprendiz encontrado.
                        while ($aprendiz = mysqli_fetch_assoc($resultadoAprendizes)) {
                            // Coleta e limpa os dados do aprendiz.
                            $idAprendiz = htmlspecialchars($aprendiz['idUsuario'] ?? '');
                            $nomeAprendiz = htmlspecialchars($aprendiz['nomeUsuario'] ?? 'Nome Indisponível');
                            $emailAprendiz = htmlspecialchars($aprendiz['emailUsuario'] ?? 'Email Indisponível');

                            // Exibe o card do aprendiz.
                            echo '
                            <div class="card bg-secondary text-white mb-4 shadow">
                                <div class="card-header bg-danger bg-gradient">
                                    <h4 class="mb-0">' . $nomeAprendiz . ' <small>(' . $emailAprendiz . ')</small></h4>
                                </div>
                                <div class="card-body">
                                    <h5 class="mb-3">Vídeos Concluídos:</h5>
                                    <ul class="list-group list-group-flush">';

                            // Query SQL para buscar os vídeos concluídos por este aprendiz.
                            $sqlBuscarConcluidos = "SELECT cv.idVideo, vt.tituloVideo, cv.dataConclusao,
                                                    (SELECT COUNT(*) FROM Certificados WHERE idUsuario = cv.idUsuario AND idTreinamento = cv.idVideo) AS certificadoEmitido
                                                    FROM ConclusaoVideoUsuario cv
                                                    JOIN VideosTreinamento vt ON cv.idVideo = vt.idVideo
                                                    WHERE cv.idUsuario = ?
                                                    ORDER BY cv.dataConclusao DESC";
                            // Prepara a declaração SQL para buscar vídeos concluídos.
                            $stmtConcluidos = mysqli_prepare($conn, $sqlBuscarConcluidos);

                            // Verifica se a preparação da declaração foi bem-sucedida.
                            if ($stmtConcluidos) {
                                // Vincula o ID do aprendiz como parâmetro.
                                mysqli_stmt_bind_param($stmtConcluidos, 'i', $idAprendiz);
                                // Executa a declaração.
                                mysqli_stmt_execute($stmtConcluidos);
                                // Obtém o resultado da execução.
                                $resultadoConcluidos = mysqli_stmt_get_result($stmtConcluidos);

                                // Verifica se o aprendiz concluiu algum vídeo.
                                if (mysqli_num_rows($resultadoConcluidos) > 0) {
                                    // Itera sobre cada vídeo concluído.
                                    while ($videoConcluido = mysqli_fetch_assoc($resultadoConcluidos)) {
                                        // Coleta e limpa os dados do vídeo concluído.
                                        $idVideoConcluido = htmlspecialchars($videoConcluido['idVideo'] ?? '');
                                        $tituloVideoConcluido = htmlspecialchars($videoConcluido['tituloVideo'] ?? 'Título Indisponível');
                                        // Cria um objeto DateTime para formatar a data de conclusão.
                                        $dataConclusao = new DateTime(htmlspecialchars($videoConcluido['dataConclusao'] ?? ''));
                                        $dataConclusaoFormatada = $dataConclusao->format('d/m/Y H:i');
                                        // Verifica se um certificado já foi emitido para este vídeo e aprendiz.
                                        $certificadoEmitido = $videoConcluido['certificadoEmitido'] > 0;

                                        // Exibe cada vídeo concluído na lista.
                                        echo '
                                        <li class="list-group-item bg-dark text-white d-flex justify-content-between align-items-center">
                                            <div>
                                                ' . $tituloVideoConcluido . ' <br>
                                                <small class="text-muted">Concluído em: ' . $dataConclusaoFormatada . '</small>
                                            </div>';
                                        // Se o certificado já foi emitido, exibe um badge de sucesso.
                                        if ($certificadoEmitido) {
                                            echo '<span class="badge bg-success">Certificado Emitido <i class="fas fa-certificate ms-1"></i></span>';
                                        } else {
                                            // Caso contrário, exibe um formulário para emitir o certificado.
                                            echo '
                                            <form action="actionEmitirCertificado.php" method="POST" class="d-inline">
                                                <input type="hidden" name="idAprendiz" value="' . $idAprendiz . '">
                                                <input type="hidden" name="idVideo" value="' . $idVideoConcluido . '">
                                                <button type="submit" class="btn btn-primary btn-sm">Emitir Certificado</button>
                                            </form>';
                                        }
                                        echo '</li>';
                                    }
                                } else {
                                    // Mensagem se nenhum vídeo foi concluído pelo aprendiz.
                                    echo '<li class="list-group-item bg-dark text-white">Nenhum vídeo concluído por este aprendiz ainda.</li>';
                                }
                                // Fecha a declaração de vídeos concluídos.
                                mysqli_stmt_close($stmtConcluidos);
                            } else {
                                // Mensagem de erro se a preparação da consulta de vídeos concluídos falhar.
                                echo '<li class="list-group-item bg-dark text-white text-danger">Erro ao preparar a consulta de vídeos concluídos.</li>';
                            }
                            echo '</ul></div></div>'; // Fecha o card do aprendiz.
                        }
                    } else {
                        // Mensagem se nenhum aprendiz corresponder ao termo de busca.
                        echo '<p class="lead text-center">Nenhum aprendiz cadastrado que corresponda ao termo de busca.</p>';
                    }
                    // Fecha a declaração de aprendizes.
                    mysqli_stmt_close($stmtAprendizes);
                } else {
                    // Mensagem de erro se a preparação da consulta de aprendizes falhar.
                    echo '<p class="lead text-center text-danger">Erro ao preparar a consulta de aprendizes.</p>';
                }
                // Fecha a conexão com o banco de dados.
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</section>

<?php
// Inclui o rodapé da página.
include('footer.php');
?>