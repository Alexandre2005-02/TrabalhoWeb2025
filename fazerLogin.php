<?php
// Inclui o cabeçalho da página (geralmente contém tags HTML, CSS e scripts comuns).
include 'header.php';
?>

<div class="container mt-5 d-flex justify-content-center">
  <div class="card bg-dark text-white shadow p-4" style="width: 100%; max-width: 500px;">
    <h2 class="mb-4 text-center">Login</h2>

    <form action="actionLogin.php" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control bg-secondary text-white border-0" id="email" name="emailUsuario" required>
      </div>

      <div class="mb-3">
        <label for="senha" class="form-label">Senha:</label>
        <input type="password" class="form-control bg-secondary text-white border-0" id="senha" name="senhaUsuario" required>
      </div>
      <button type="submit" class="btn btn-danger w-100">Entrar</button>
    </form>

    <div class="mt-3 text-center">
      <p>Não possui cadastro? <a href="cadastrarUsuario.php" class="text-white">Cadastre-se Aqui!</a></p>
    </div>
  </div>
</div>

<?php
// Inclui o rodapé da página (geralmente contém tags de fechamento HTML, scripts e outros).
include 'footer.php';
?>