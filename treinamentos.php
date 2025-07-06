<?php
// Inclui o cabeçalho da página (contém a tag <html>, <head>, e o início do <body>, além da barra de navegação).
include('header.php');
// Inclui o arquivo de conexão com o banco de dados.
include('conexaoBd.php');
?>

<header class="bg-danger bg-gradient text-white">
    <div class="container px-10 text-center py-5">
        <h1 class="fw-bolder">Treinamentos</h1>
        <p class="lead">Assista aos nossos vídeos de treinamento para se capacitar!</p>
    </div>
</header>

<section class="py-5 bg-dark text-white">
    <div class="container px-5">
        <h2 class="text-center mb-5">Nossos Treinamentos em Vídeo</h2>

        <?php
        // Verifica se o usuário está logado e se o tipo de usuário é 'Tutor'.
        // Se for um tutor, exibe um botão para adicionar novos vídeos.
        if (isset($_SESSION['logado']) && $_SESSION['logado'] === true && isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] === 'Tutor') {
            echo '
            <div class="text-center mb-4">
                <a href="adicionarVideo.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus-circle me-2"></i> Adicionar Novo Vídeo
                </a>
            </div>';
        }
        ?>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php
            // Query SQL para buscar todos os vídeos de treinamento, ordenados pela data de adição mais recente.
            $sqlBuscarVideos = "SELECT * FROM VideosTreinamento ORDER BY dataAdicao DESC";
            // Executa a query no banco de dados.
            $resultadoVideos = mysqli_query($conn, $sqlBuscarVideos);

            // Verifica se a consulta retornou resultados (se há vídeos de treinamento).
            if (mysqli_num_rows($resultadoVideos) > 0) {
                // Itera sobre cada vídeo encontrado no resultado da consulta.
                while ($video = mysqli_fetch_assoc($resultadoVideos)) {
                    // Limpa e armazena os dados do vídeo.
                    $idVideo = htmlspecialchars($video['idVideo'] ?? '');
                    $titulo = htmlspecialchars($video['tituloVideo'] ?? 'Título Indisponível');
                    $descricao = htmlspecialchars($video['descricaoVideo'] ?? 'Descrição Indisponível');
                    // A URL de incorporação (embed) do vídeo.
                    $urlEmbed = htmlspecialchars($video['urlVideo'] ?? '#');

                    // Variável para controlar se o vídeo já foi concluído pelo usuário logado. Inicializa como falso.
                    $estaConcluido = false;
                    // Verifica se o usuário está logado e é um 'Aprendiz'.
                    if (isset($_SESSION['logado']) && $_SESSION['logado'] === true && $_SESSION['tipoUsuario'] === 'Aprendiz') {
                        // Obtém o ID do usuário logado.
                        $idUsuario = $_SESSION['idUsuario'];
                        // Query para verificar se o vídeo já foi marcado como concluído por este aprendiz.
                        $sqlVerificarConclusao = "SELECT COUNT(*) FROM ConclusaoVideoUsuario WHERE idUsuario = ? AND idVideo = ?";
                        // Prepara a declaração SQL.
                        $stmtConclusao = mysqli_prepare($conn, $sqlVerificarConclusao);

                        // Se a preparação for bem-sucedida.
                        if ($stmtConclusao) {
                            // Vincula os parâmetros (ID do usuário e ID do vídeo).
                            mysqli_stmt_bind_param($stmtConclusao, 'ii', $idUsuario, $idVideo);
                            // Executa a declaração.
                            mysqli_stmt_execute($stmtConclusao);
                            // Armazena o resultado da consulta.
                            mysqli_stmt_bind_result($stmtConclusao, $countConclusoes);
                            // Pega o resultado (o número de conclusões).
                            mysqli_stmt_fetch($stmtConclusao);
                            // Se o contador for maior que 0, o vídeo já foi concluído.
                            if ($countConclusoes > 0) {
                                $estaConcluido = true;
                            }
                            // Fecha a declaração.
                            mysqli_stmt_close($stmtConclusao);
                        }
                    }

                    // Exibe o card para cada vídeo.
                    echo '
                    <div class="col">
                        <div class="card h-100 bg-secondary text-white shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">' . $titulo . '</h5>
                                <p class="card-text">' . $descricao . '</p>
                                <a href="' . $urlEmbed . '" target="_blank" class="btn btn-outline-light">Assistir no YouTube</a>';

                    // Se o usuário estiver logado e for um 'Aprendiz'.
                    if (isset($_SESSION['logado']) && $_SESSION['logado'] === true && $_SESSION['tipoUsuario'] === 'Aprendiz') {
                        // Se o vídeo já foi concluído, exibe um botão desabilitado de "Concluído".
                        if ($estaConcluido) {
                            echo '<button class="btn btn-success w-100 mt-3" disabled><i class="fas fa-check-circle me-2"></i>Concluído</button>';
                        } else {
                            // Caso contrário, exibe um formulário para marcar o vídeo como concluído.
                            echo '
                                <form action="actionCompletarVideo.php" method="POST" class="mt-3">
                                    <input type="hidden" name="idVideo" value="' . $idVideo . '">
                                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-clipboard-check me-2"></i>Marcar como Concluído</button>
                                </form>';
                        }
                    }
                    echo '
                            </div>
                        </div>
                    </div>';
                }
            } else {
                // Mensagem se nenhum treinamento em vídeo estiver disponível.
                echo '<div class="col-12 text-center">
                        <p class="lead">Nenhum treinamento em vídeo disponível no momento.</p>
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