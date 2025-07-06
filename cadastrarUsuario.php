<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    // Inclui o cabeçalho da página (geralmente contém tags HTML de abertura, metatags, links para CSS e scripts).
    include 'header.php';
    ?>

    <div class="container mt-5 d-flex justify-content-center">
        <div class="card bg-dark text-white shadow p-4" style="width: 100%; max-width: 500px;">
            <h2 class="mb-4 text-center">Cadastro de Usuário</h2>

            <form action="actionUsuario.php" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control bg-secondary text-white border-0" id="nome" name="nomeUsuario" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control bg-secondary text-white border-0" id="email" name="emailUsuario" required>
                </div>

                <div class="mb-3">
                    <label for="usuario_tipo" class="form-label">Tipo de Usuário</label>
                    <select class="form-select bg-secondary text-white border-0" id="usuario_tipo" name="usuario_tipo" required>
                        <option value="" class="text-dark">Selecione</option>
                        <option value="Tutor" class="text-dark">Tutor</option>
                        <option value="Aprendiz" class="text-dark">Aprendiz</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control bg-secondary text-white border-0" id="senha" name="senha" required>
                </div>

                <div class="mb-3">
                    <label for="confirma_senha" class="form-label">Confirmar Senha</label>
                    <input type="password" class="form-control bg-secondary text-white border-0" id="confirma_senha" name="confirma_senha" required>
                </div>

                <button type="submit" class="btn btn-danger w-100">Cadastrar</button>
            </form>

            <div class="mt-3 text-center">
                <a href="fazerLogin.php" class="text-white">Já possui cadastro? Faça login</a>
            </div>
        </div>
    </div>
    
    <?php
    // Inclui o rodapé da página.
    include 'footer.php';
    ?>
</body>
</html>