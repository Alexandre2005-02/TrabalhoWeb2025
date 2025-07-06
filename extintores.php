<?php include('header.php'); ?>

<header class="bg-danger bg-gradient text-white">
    <div class="container px-10 text-center py-5">
        <h1 class="fw-bolder">Extintores de Incêndio</h1>
        <p class="lead">Conheça os tipos, suas classes de fogo e aplicações</p>
    </div>
</header>

<section class="py-5 bg-dark text-white">
    <div class="container text-center">
        <h2 class="mb-4">O que são Extintores de Incêndio?</h2>
        <p class="lead px-lg-5">
            Os extintores de incêndio são equipamentos portáteis de segurança, essenciais para o combate a focos de incêndio em seu estágio inicial. Eles funcionam removendo um dos elementos do "triângulo do fogo" (calor, oxigênio e combustível), evitando que o incêndio se alastre. É fundamental saber qual tipo de extintor usar para cada classe de fogo, pois o uso incorreto pode ser ineficaz ou até mesmo perigoso.
        </p>
    </div>
</section>

<section class="py-5 bg-secondary">
    <div class="container">
        <h2 class="text-center text-white mb-5">Tipos de Extintores e Suas Aplicações</h2>

        <div class="card bg-dark text-white border border-info mb-4 shadow-lg">
            <div class="card-header bg-info bg-gradient text-dark fw-bold">
                <i class="fas fa-tint me-2"></i>Extintor de Água (H₂O)
            </div>
            <div class="card-body">
                <h5 class="card-title text-info">Classe de Fogo: <span class="fw-bold">A</span></h5>
                <p class="card-text"><strong>Ideal para:</strong> Materiais sólidos como papel, madeira, tecido e borracha.</p>
                <p class="card-text"><strong>Usos Comuns:</strong> Incêndios em materiais combustíveis comuns.</p>
                <p class="card-text text-warning"><strong>Importante: NÃO USAR:</strong> Em equipamentos elétricos (risco de choque) ou em líquidos e gases inflamáveis.</p>
            </div>
        </div>

        <div class="card bg-dark text-white border border-warning mb-4 shadow-lg">
            <div class="card-header bg-warning bg-gradient text-dark fw-bold">
                <i class="fas fa-cloud me-2"></i>Extintor de Dióxido de Carbono (CO₂)
            </div>
            <div class="card-body">
                <h5 class="card-title text-warning">Classe de Fogo: <span class="fw-bold">B e C</span></h5>
                <p class="card-text"><strong>Ideal para:</strong> Líquidos e gases inflamáveis (B) e Equipamentos elétricos energizados (C).</p>
                <p class="card-text"><strong>Usos Comuns:</strong> Combate a incêndios em quadros elétricos, servidores, motores e líquidos inflamáveis.</p>
                <p class="card-text text-warning"><strong>Importante: NÃO USAR:</strong> Em materiais sólidos (classe A), pois pode não resfriar o suficiente para evitar a reignição.</p>
            </div>
        </div>

        <div class="card bg-dark text-white border border-light mb-4 shadow-lg">
            <div class="card-header bg-light bg-gradient text-dark fw-bold">
                <i class="fas fa-fire-extinguisher me-2"></i>Extintor de Pó Químico Seco (BC)
            </div>
            <div class="card-body">
                <h5 class="card-title text-light">Classe de Fogo: <span class="fw-bold">B e C</span></h5>
                <p class="card-text"><strong>Ideal para:</strong> Líquidos e gases inflamáveis (B) e Equipamentos elétricos energizados (C).</p>
                <p class="card-text"><strong>Usos Comuns:</strong> Postos de gasolina, indústrias químicas e locais com risco de incêndios elétricos.</p>
                <p class="card-text text-warning"><strong>Importante: NÃO USAR:</strong> Em materiais sólidos (classe A) e em cozinhas (classe K), pois o pó pode danificar equipamentos e contaminar alimentos.</p>
            </div>
        </div>

        <div class="card bg-dark text-white border border-success mb-4 shadow-lg">
            <div class="card-header bg-success bg-gradient text-dark fw-bold">
                <i class="fas fa-house-fire me-2"></i>Extintor de Pó Químico Seco (ABC)
            </div>
            <div class="card-body">
                <h5 class="card-title text-success">Classe de Fogo: <span class="fw-bold">A, B e C</span></h5>
                <p class="card-text"><strong>Ideal para:</strong> Materiais sólidos (A), líquidos inflamáveis (B) e equipamentos elétricos (C).</p>
                <p class="card-text"><strong>Usos Comuns:</strong> É o extintor mais versátil e comum, ideal para residências, escritórios e veículos.</p>
                <p class="card-text text-warning"><strong>Importante: NÃO USAR:</strong> Em metais combustíveis (classe D) e em cozinhas (classe K), pois pode não ser eficaz.</p>
            </div>
        </div>

        <div class="card bg-dark text-white border border-primary mb-4 shadow-lg">
            <div class="card-header bg-primary bg-gradient text-dark fw-bold">
                <i class="fas fa-spray-can me-2"></i>Extintor de Espuma Mecânica (AFFF)
            </div>
            <div class="card-body">
                <h5 class="card-title text-primary">Classe de Fogo: <span class="fw-bold">A e B</span></h5>
                <p class="card-text"><strong>Ideal para:</strong> Materiais sólidos (A) e líquidos inflamáveis (B).</p>
                <p class="card-text"><strong>Usos Comuns:</strong> Incêndios em líquidos inflamáveis, como álcool, gasolina e óleos, formando uma camada que abafa o fogo.</p>
                <p class="card-text text-warning"><strong>Importante: NÃO USAR:</strong> Em equipamentos elétricos (C) e em gorduras de cozinha (K).</p>
            </div>
        </div>
        
        <div class="card bg-dark text-white border border-secondary mb-4 shadow-lg">
            <div class="card-header bg-secondary bg-gradient text-dark fw-bold">
                <i class="fas fa-robot me-2"></i>Extintor de Pó Especial (Classe D)
            </div>
            <div class="card-body">
                <h5 class="card-title text-secondary">Classe de Fogo: <span class="fw-bold">D</span></h5>
                <p class="card-text"><strong>Ideal para:</strong> Metais combustíveis como magnésio, potássio, sódio e titânio.</p>
                <p class="card-text"><strong>Usos Comuns:</strong> Indústrias metalúrgicas, laboratórios e locais que manuseiam metais reativos.</p>
                <p class="card-text text-warning"><strong>Importante: NÃO USAR:</strong> Em qualquer outra classe de fogo, pois é ineficaz e pode ser perigoso.</p>
            </div>
        </div>

        <div class="card bg-dark text-white border border-danger mb-4 shadow-lg">
            <div class="card-header bg-danger bg-gradient text-dark fw-bold">
                <i class="fas fa-utensils me-2"></i>Extintor de Acetato de Potássio (Classe K)
            </div>
            <div class="card-body">
                <h5 class="card-title text-danger">Classe de Fogo: <span class="fw-bold">K</span></h5>
                <p class="card-text"><strong>Ideal para:</strong> Óleos e gorduras de cozinha (origem animal ou vegetal).</p>
                <p class="card-text"><strong>Usos Comuns:</strong> Cozinhas industriais, restaurantes e food trucks.</p>
                <p class="card-text text-warning"><strong>Importante: NÃO USAR:</strong> Em outras classes de fogo. É específico para gorduras quentes.</p>
            </div>
        </div>

    </div>
</section>

<?php include('footer.php'); ?>