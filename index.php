<?php
include('header.php');
?>
<header  class="bg-danger bg-gradient text-white">
    <div class="container px-10 text-center">
        <h1 class="fw-bolder">
            <?php
            if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
                $nomeCompleto = $_SESSION['nomeUsuario'];
                $partesNome = explode(' ', $nomeCompleto);
                $primeiroNome = $partesNome[0];

                echo "Bem-vindo, " . htmlspecialchars($primeiroNome) . " ao Brigadista Virtual!";
            } else {
                echo "Bem-vindo ao Brigadista Virtual!";
            }
            ?>
        </h1>
        <p class="lead">Informações e Treinamentos!</p>
    </div>
</header>
<section class="py-5 d-flex align-items-center justify-content-center">
    <div class="container text-center text-light">
        <h2>Brigadista Virtual</h2>
        <p>Aqui você encontra informações e orientações sobre como agir em caso de incidentes, incluindo incêndios e primeiros socorros. Também disponibilizamos uma seção exclusiva com nossos treinamentos.</p>
    </div>
</section>

<?php
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    ?>
    <div class="card text-white bg-dark mb-3 w-100 shadow-lg" style="padding-top: 20px; padding-bottom: 20px;">
      <div class="card-body text-center">
        <h2 class="card-title"><i class="fas fa-video me-2"></i>Treinamentos em Vídeo</h2>
        <p class="card-text">Assista aos nossos vídeos de treinamento para se capacitar e fazer a diferença!</p>
        <a href="treinamentos.php" class="btn btn-light text-dark">Assistir Treinamentos</a>
      </div>
    </div>
    <?php
} else {
    ?>
    <div class="card text-white bg-dark mb-3 w-100 shadow-lg" style="padding-top: 20px; padding-bottom: 20px;">
      <div class="card-body text-center">
        <h2 class="card-title"><i class="fas fa-lock me-2"></i>Treinamentos Exclusivos</h2>
        <p class="card-text">Para acessar nossos treinamentos em vídeo, por favor, faça login.</p>
        <a href="fazerLogin.php" class="btn btn-light text-dark">Fazer Login</a>
      </div>
    </div>
    <?php
}
?>

<div class="card text-white bg-danger mb-3 w-100" style="min-height: 200px;">
  <div class="row g-0 h-100">
    <div class="col-md-4 h-100">
      <img src="img/extintor.jpg" class="img-fluid rounded-start w-55 h-100 object-fit-cover" alt="Extintor de Incêndio">
    </div>
    <div class="col-md-8 d-flex align-items-center">
      <div class="card-body">
        <h2 class="card-title">Extintores de Incêndio</h2>
        <h5 class="card-text">Saiba mais sobre os extintores de incêndio e para que servem.</h5>
        <a href="extintores.php" class="btn btn-light text-danger">Saiba mais</a>
      </div>
    </div>
  </div>
</div>
<div class="card text-white bg-danger mb-3 w-100" style="min-height: 200px;">
  <div class="row g-0 h-100">
    <div class="col-md-4 h-100">
      <img src="img/socorros.jpg" class="img-fluid rounded-start w-55 h-100 object-fit-cover" alt="Primeiros Socorros">
    </div>
    <div class="col-md-8 d-flex align-items-center">
      <div class="card-body">
        <h2 class="card-title">Primeiros Socorros</h2>
        <h5 class="card-text">Saiba mais sobre Primeiros Socorros. Como agir em caso de emergência.</h5>
        <a href="primeirosSocorros.php" class="btn btn-light text-danger ">Saiba Mais</a>
      </div>
    </div>
  </div>
</div>
<div class="card text-white bg-danger mb-3 w-100" style="min-height: 200px;">
  <div class="row g-0 h-100">
    <div class="col-md-4 h-100">
      <img src="img/incendio.jpg" class="img-fluid rounded-start w-55 h-100 object-fit-cover" alt="Incêndio e Prevenção">
    </div>
    <div class="col-md-8 d-flex align-items-center">
      <div class="card-body">
        <h2 class="card-title">Incêndio e Prevenção</h2>
        <h5 class="card-text">Saiba mais sobre Incêndios, como acontece e como previnir caso esteja ao seu alcance.</h5>
        <a href="incendio.php" class="btn btn-light text-danger ">Saiba Mais</a>
      </div>
    </div>
  </div>
</div>
<?php include('footer.php'); ?>