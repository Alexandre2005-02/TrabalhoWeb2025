<?php include('header.php'); ?>

<header class="bg-danger bg-gradient text-white">
    <div class="container px-10 text-center py-5">
        <h1 class="fw-bolder">Incêndios: Prevenção e Combate</h1>
        <p class="lead">Entenda os incêndios, como preveni-los e como agir</p>
    </div>
</header>

<section class="py-5 bg-dark text-white">
    <div class="container text-center">
        <h2 class="mb-4">O que é um Incêndio?</h2>
        <p class="lead px-lg-5">
            Um incêndio é uma ocorrência de fogo não controlada que pode causar grandes danos materiais, ambientais e, principalmente, colocar vidas em risco. Compreender sua origem e desenvolvimento é crucial para a prevenção e o combate eficaz.
        </p>
    </div>
</section>

<section class="py-5 bg-secondary">
    <div class="container">
        <h2 class="text-center text-white mb-5">Como o Fogo Ocorre: O Triângulo do Fogo</h2>

        <div class="card bg-dark text-white border border-warning mb-4 shadow-lg">
            <div class="card-header bg-warning bg-gradient text-dark fw-bold">
                <i class="fas fa-triangle-exclamation me-2"></i>O Triângulo do Fogo (ou Tetraedro do Fogo)
            </div>
            <div class="card-body">
                <h5 class="card-title text-warning">Para que o fogo exista, são necessários três elementos básicos:</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-fire text-warning me-2"></i><strong>Combustível:</strong> Material que queima (ex: madeira, papel, gasolina, gás).</li>
                    <li><i class="fas fa-fan text-warning me-2"></i><strong>Oxigênio:</strong> Gás presente no ar que alimenta a combustão.</li>
                    <li><i class="fas fa-temperature-full text-warning me-2"></i><strong>Calor (ou Ignição):</strong> Energia suficiente para iniciar e manter a reação.</li>
                </ul>
                <p class="card-text">
                    Quando esses três elementos (Combustível, Oxigênio e Calor) estão presentes em proporções adequadas, ocorre a combustão. O combate a incêndios geralmente visa remover um ou mais desses elementos. Em situações mais complexas, especialmente em incêndios maiores, adiciona-se o quarto elemento, a <strong>Reação em Cadeia</strong>, formando o Tetraedro do Fogo.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-dark text-white">
    <div class="container">
        <h2 class="text-center text-white mb-5">Tipos de Incêndio (Classes de Fogo)</h2>
        <p class="lead text-center px-lg-5 mb-5">
            Os incêndios são classificados de acordo com o tipo de material combustível envolvido, o que determina o agente extintor mais adequado.
        </p>

        <div class="card bg-secondary text-white border border-info mb-4 shadow-lg">
            <div class="card-header bg-info bg-gradient text-dark fw-bold">
                <i class="fas fa-fire-burner me-2"></i>Classe A: Sólidos Combustíveis
            </div>
            <div class="card-body">
                <h5 class="card-title text-info">Características:</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-info me-2"></i>Incêndios em materiais que queimam em superfície e profundidade.</li>
                    <li><i class="fas fa-check-circle text-info me-2"></i>Deixam resíduos (cinzas e brasas).</li>
                </ul>
                <p class="card-text"><strong>Exemplos:</strong> Madeira, papel, tecido, borracha, plástico.</p>
                <p class="card-text text-light"><strong>Agente Extintor Indicado:</strong> Água (H₂O) age por resfriamento e abafamento.</p>
            </div>
        </div>

        <div class="card bg-secondary text-white border border-warning mb-4 shadow-lg">
            <div class="card-header bg-warning bg-gradient text-dark fw-bold">
                <i class="fas fa-gas-pump me-2"></i>Classe B: Líquidos e Gases Inflamáveis
            </div>
            <div class="card-body">
                <h5 class="card-title text-warning">Características:</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-warning me-2"></i>Incêndios em líquidos, gases ou graxas que queimam apenas na superfície.</li>
                    <li><i class="fas fa-check-circle text-warning me-2"></i>Não deixam resíduos.</li>
                </ul>
                <p class="card-text"><strong>Exemplos:</strong> Gasolina, álcool, óleo, querosene, propano, butano.</p>
                <p class="card-text text-light"><strong>Agente Extintor Indicado:</strong> Pó Químico Seco (PQS), CO₂, espuma mecânica (AFFF). Agem por abafamento.</p>
            </div>
        </div>

        <div class="card bg-secondary text-white border border-light mb-4 shadow-lg">
            <div class="card-header bg-light bg-gradient text-dark fw-bold">
                <i class="fas fa-bolt me-2"></i>Classe C: Equipamentos Elétricos Energizados
            </div>
            <div class="card-body">
                <h5 class="card-title text-light">Características:</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-light me-2"></i>Incêndios em equipamentos ou instalações elétricas sob carga.</li>
                    <li><i class="fas fa-check-circle text-light me-2"></i>O perigo é o risco de choque elétrico.</li>
                </ul>
                <p class="card-text"><strong>Exemplos:</strong> Motores, geradores, painéis elétricos, computadores, transformadores.</p>
                <p class="card-text text-light"><strong>Agente Extintor Indicado:</strong> CO₂, Pó Químico Seco (PQS). Agem por abafamento sem conduzir eletricidade.</p>
            </div>
        </div>

        <div class="card bg-secondary text-white border border-success mb-4 shadow-lg">
            <div class="card-header bg-success bg-gradient text-dark fw-bold">
                <i class="fas fa-atom me-2"></i>Classe D: Metais Pirofóricos
            </div>
            <div class="card-body">
                <h5 class="card-title text-success">Características:</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-success me-2"></i>Incêndios em metais combustíveis que queimam em altas temperaturas.</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Podem reagir violentamente com a água.</li>
                </ul>
                <p class="card-text"><strong>Exemplos:</strong> Magnésio, titânio, zircônio, sódio, potássio.</p>
                <p class="card-text text-light"><strong>Agente Extintor Indicado:</strong> Pó químico especial (extintores Classe D) específicos para cada metal. Agem por abafamento e isolamento.</p>
            </div>
        </div>

        <div class="card bg-secondary text-white border border-danger mb-4 shadow-lg">
            <div class="card-header bg-danger bg-gradient text-dark fw-bold">
                <i class="fas fa-burger-soda me-2"></i>Classe K: Óleos e Gorduras de Cozinha
            </div>
            <div class="card-body">
                <h5 class="card-title text-danger">Características:</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-danger me-2"></i>Incêndios em óleos e gorduras vegetais ou animais (cozinhas).</li>
                    <li><i class="fas fa-check-circle text-danger me-2"></i>Queimam em temperaturas extremamente altas.</li>
                </ul>
                <p class="card-text"><strong>Exemplos:</strong> Óleos de fritura em cozinhas comerciais e residenciais.</p>
                <p class="card-text text-light"><strong>Agente Extintor Indicado:</strong> Acetato de Potássio (solução aquosa). Cria uma camada de espuma que abafa e resfria.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-dark text-white">
    <div class="container">
        <h2 class="text-center text-white mb-5">Princípio de Incêndio: Como Identificar e Agir</h2>
        <p class="lead text-center px-lg-5 mb-5">
            Um princípio de incêndio é o fogo em seu estágio inicial, controlável por pessoas não especializadas com o uso de extintores portáteis ou outros meios simples. Agir rapidamente é fundamental.
        </p>

        <div class="card bg-secondary text-white border border-primary mb-4 shadow-lg">
            <div class="card-header bg-primary bg-gradient text-dark fw-bold">
                <i class="fas fa-exclamation-triangle me-2"></i>Sinais de um Princípio de Incêndio:
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><i class="fas fa-smog text-primary me-2"></i>Fumaça incomum ou com cheiro forte (queimado).</li>
                    <li><i class="fas fa-fire-alt text-primary me-2"></i>Chamas visíveis, mesmo que pequenas.</li>
                    <li><i class="fas fa-plug text-primary me-2"></i>Cheiro de fiação queimada ou superaquecimento.</li>
                    <li><i class="fas fa-bell text-primary me-2"></i>Ativação de alarmes de fumaça.</li>
                </ul>
            </div>
        </div>

        <div class="card bg-secondary text-white border border-danger mb-4 shadow-lg">
            <div class="card-header bg-danger bg-gradient text-dark fw-bold">
                <i class="fas fa-person-running me-2"></i>Como Agir em um Princípio de Incêndio (Regra do "PA.S.S."):
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><i class="fas fa-lock text-danger me-2"></i><strong>P - Puxar:</strong> Puxe o pino de segurança do extintor.</li>
                    <li><i class="fas fa-bullseye text-danger me-2"></i><strong>A - Apontar:</strong> Aponte o bico ou a mangueira para a base do fogo.</li>
                    <li><i class="fas fa-hand-fist text-danger me-2"></i><strong>S - Apertar:</strong> Aperte o gatilho para liberar o agente extintor.</li>
                    <li><i class="fas fa-arrows-left-right text-danger me-2"></i><strong>S - Varrer:</strong> Movimente o bico de um lado para o outro na base do fogo.</li>
                </ul>
                <p class="card-text text-warning">
                    <strong>Importante:</strong> Só combata o fogo se você souber usar o extintor, se o fogo for pequeno e contido, e se houver uma rota de fuga segura. Caso contrário, evacue o local e chame o Corpo de Bombeiros (193).
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-secondary text-white">
    <div class="container">
        <h2 class="text-center text-white mb-5">Prevenção de Incêndios: Dicas Essenciais</h2>

        <div class="card bg-dark text-white border border-success mb-4 shadow-lg">
            <div class="card-header bg-success bg-gradient text-dark fw-bold">
                <i class="fas fa-shield-alt me-2"></i>Medidas Preventivas:
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-success me-2"></i>Não sobrecarregue tomadas elétricas e verifique fiação antiga.</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Mantenha materiais inflamáveis longe de fontes de calor.</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Nunca fume na cama ou perto de materiais combustíveis.</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Cuidado ao manusear velas, incensos e fogos de artifício.</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Realize manutenção regular em aparelhos a gás e elétricos.</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Mantenha rotas de fuga desobstruídas e identifique saídas de emergência.</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Tenha detectores de fumaça e extintores de incêndio em locais estratégicos.</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Eduque todos os moradores/ocupantes sobre segurança contra incêndio.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-dark text-white">
    <div class="container">
        <h2 class="text-center text-white mb-5">Informações Adicionais Importantes</h2>

        <div class="card bg-secondary text-white border border-info mb-4 shadow-lg">
            <div class="card-header bg-info bg-gradient text-dark fw-bold">
                <i class="fas fa-phone-volume me-2"></i>Números de Emergência
            </div>
            <div class="card-body">
                <p class="card-text">Em caso de incêndio, ligue imediatamente para o Corpo de Bombeiros.</p>
                <h5 class="card-title text-info"><i class="fas fa-phone me-2"></i>193 (Corpo de Bombeiros)</h5>
                <p class="card-text">Lembre-se de fornecer o endereço completo e detalhes da situação para agilizar o atendimento.</p>
            </div>
        </div>

        <div class="card bg-secondary text-white border border-primary mb-4 shadow-lg">
            <div class="card-header bg-primary bg-gradient text-dark fw-bold">
                <i class="fas fa-people-group me-2"></i>Importância do Treinamento de Brigadistas
            </div>
            <div class="card-body">
                <p class="card-text">Brigadistas são essenciais para a segurança contra incêndios em qualquer ambiente. Eles são treinados para:</p>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-primary me-2"></i>Identificar e combater princípios de incêndio.</li>
                    <li><i class="fas fa-check-circle text-primary me-2"></i>Realizar a evacuação segura de pessoas.</li>
                    <li><i class="fas fa-check-circle text-primary me-2"></i>Prestar primeiros socorros.</li>
                    <li><i class="fas fa-check-circle text-primary me-2"></i>Colaborar com o Corpo de Bombeiros.</li>
                </ul>
                <p class="card-text">Considere participar de nossos treinamentos para se tornar um brigadista e fazer a diferença!</p>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>