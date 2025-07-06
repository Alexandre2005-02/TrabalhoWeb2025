<?php
// Inclui o cabeçalho da página (geralmente contém HTML, CSS e scripts comuns).
include('header.php');

// Verifica se o usuário está logado, se a variável de sessão 'logado' é verdadeira
// e se o tipo de usuário é 'Tutor'. Se alguma dessas condições não for atendida,
// o usuário é redirecionado para a página de índice (index.php) e o script é encerrado.
// Esta é uma medida de segurança para garantir que apenas tutores logados possam acessar esta página.
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || $_SESSION['tipoUsuario'] !== 'Tutor') {
    header('Location: index.php');
    exit();
}
?>

<header class="bg-danger bg-gradient text-white">
    <div class="container px-10 text-center py-5">
        <h1 class="fw-bolder">Adicionar Novo Treinamento em Vídeo</h1>
        <p class="lead">Preencha os dados para adicionar um novo vídeo à plataforma.</p>
    </div>
</header>

<section class="py-5 bg-dark text-white">
    <div class="container px-5">
        <div class="card bg-secondary text-white shadow p-4 mx-auto" style="max-width: 700px;">
            <h2 class="mb-4 text-center">Formulário de Adição de Vídeo</h2>

            <?php
            // Bloco PHP para exibir mensagens de status com base nos parâmetros da URL.
            if (isset($_GET['status'])) {
                // Se o status for 'success', exibe uma mensagem de sucesso.
                if ($_GET['status'] == 'success') {
                    echo '<div class="alert alert-success text-center">Vídeo adicionado com sucesso!</div>';
                } // Se o status for 'error', exibe uma mensagem de erro geral.
                elseif ($_GET['status'] == 'error') {
                    echo '<div class="alert alert-danger text-center">Erro ao adicionar o vídeo. Tente novamente.</div>';
                } // Se o status for 'invalid_data', exibe uma mensagem de dados inválidos (provavelmente URL incorreta).
                elseif ($_GET['status'] == 'invalid_data') {
                    echo '<div class="alert alert-warning text-center">Dados inválidos. Verifique a URL do vídeo.</div>';
                }
            }
            ?>

            <form action="actionAdicionarVideo.php" method="POST">
                <div class="mb-3">
                    <label for="tituloVideo" class="form-label">Título do Vídeo</label>
                    <input type="text" class="form-control bg-dark text-white border-secondary" id="tituloVideo" name="tituloVideo" required>
                </div>

                <div class="mb-3">
                    <label for="urlVideo" class="form-label">URL do Vídeo (YouTube)</label>
                    <input type="url" class="form-control bg-dark text-white border-secondary" id="urlVideo" name="urlVideo" placeholder="Ex: https://www.youtube.com/watch?v=XXXXXXXXXXX" required>
                    <small class="form-text text-muted">Apenas URLs do YouTube são suportadas no momento.</small>
                </div>

                <div class="mb-3">
                    <label for="descricaoVideo" class="form-label">Descrição do Vídeo</label>
                    <textarea class="form-control bg-dark text-white border-secondary" id="descricaoVideo" name="descricaoVideo" rows="4"></textarea>
                </div>

                <button type="submit" class="btn btn-danger w-100">Adicionar Vídeo</button>
            </form>
        </div>
    </div>
</section>

<?php
// Inclui o rodapé da página (geralmente contém tags de fechamento HTML, scripts e outros).
include('footer.php');
?>