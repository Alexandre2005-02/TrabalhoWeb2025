<?php
// Inclui o arquivo de conexão com o banco de dados.
include('conexaoBd.php');
// Inicia a sessão para acessar variáveis de sessão.
session_start();

// Verifica se o usuário está logado, se a variável de sessão 'logado' é verdadeira
// e se o tipo de usuário é 'Tutor'. Se alguma dessas condições não for atendida,
// redireciona o usuário para a página de índice (index.php) e encerra o script.
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || $_SESSION['tipoUsuario'] !== 'Tutor') {
    header('Location: index.php');
    exit();
}

// Verifica se o método da requisição HTTP é POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário enviados via POST.
    // Usa o operador de coalescência null (??) para definir um valor padrão de string vazia
    // se a variável POST não estiver definida.
    $tituloVideo = $_POST['tituloVideo'] ?? '';
    $urlVideo = $_POST['urlVideo'] ?? '';
    $descricaoVideo = $_POST['descricaoVideo'] ?? '';
    // Obtém o ID do usuário da sessão.
    $idUsuario = $_SESSION['idUsuario'] ?? null;

    // Verifica se o título do vídeo, a URL do vídeo ou o ID do usuário estão vazios.
    // Se estiverem, redireciona para a página 'adicionarVideo.php' com um status de 'invalid_data'
    // e encerra o script.
    if (empty($tituloVideo) || empty($urlVideo) || empty($idUsuario)) {
        header('Location: adicionarVideo.php?status=invalid_data');
        exit();
    }

    // Inicializa a variável $videoId como uma string vazia.
    $videoId = '';
    // Analisa a URL do vídeo fornecida para extrair seus componentes.
    $parsedUrl = parse_url($urlVideo);
    
    // Verifica se a URL analisada contém uma string de consulta (query).
    if (isset($parsedUrl['query'])) {
        // Analisa a string de consulta em um array associativo.
        parse_str($parsedUrl['query'], $queryParams);
        // Verifica se o array de parâmetros de consulta contém a chave 'v' (comum em URLs do YouTube).
        if (isset($queryParams['v'])) {
            // Atribui o valor do parâmetro 'v' a $videoId.
            $videoId = $queryParams['v'];
        }
    // Se não houver string de consulta, verifica se a URL analisada contém um caminho (path).
    } elseif (isset($parsedUrl['path'])) { 
        // Divide o caminho da URL em partes usando '/' como delimitador.
        $pathParts = explode('/', $parsedUrl['path']);
        // Verifica se há mais de uma parte no caminho (indicando que pode haver um ID de vídeo).
        if (count($pathParts) > 1) {
            // Atribui a última parte do caminho a $videoId (comum em URLs encurtadas do YouTube).
            $videoId = end($pathParts);
        }
    }

    // Verifica se o $videoId ainda está vazio após as tentativas de extração.
    // Se estiver, significa que a URL não era válida para extração do ID do vídeo.
    // Redireciona para 'adicionarVideo.php' com status 'invalid_data' e encerra.
    if (empty($videoId)) {
        header('Location: adicionarVideo.php?status=invalid_data');
        exit();
    }

    // Constrói a URL de incorporação (embed URL) do vídeo.
    // Nota: O prefixo "https://www.youtube.com/embed/" parece incorreto para URLs de embed do YouTube.
    // O formato usual para embed do YouTube é "https://www.youtube.com/embed/{videoId}".
    $embedUrl = "https://www.youtube.com/embed/" . $videoId;

    // Prepara a query SQL para inserir os dados do vídeo na tabela 'VideosTreinamento'.
    // Os '?' são placeholders para os valores que serão vinculados posteriormente, prevenindo SQL Injection.
    $inserirVideo = "INSERT INTO VideosTreinamento (tituloVideo, descricaoVideo, urlVideo, idUsuario) VALUES (?, ?, ?, ?)";
    // Prepara a declaração SQL usando a conexão com o banco de dados.
    $stmt = mysqli_prepare($conn, $inserirVideo);

    // Verifica se a preparação da declaração foi bem-sucedida.
    if ($stmt) {
        // Vincula os parâmetros à declaração preparada.
        // 'sssi' especifica os tipos de dados dos parâmetros:
        // 's' para string (tituloVideo), 's' para string (descricaoVideo),
        // 's' para string (embedUrl), 'i' para integer (idUsuario).
        mysqli_stmt_bind_param($stmt, 'sssi', $tituloVideo, $descricaoVideo, $embedUrl, $idUsuario);

        // Executa a declaração preparada.
        if (mysqli_stmt_execute($stmt)) {
            // Se a execução for bem-sucedida, redireciona para 'adicionarVideo.php' com status 'success'.
            header('Location: adicionarVideo.php?status=success');
            exit();
        } else {
            // Se houver um erro na execução, redireciona com status 'error'.
            header('Location: adicionarVideo.php?status=error');
            exit();
        }
        // Fecha a declaração.
        mysqli_stmt_close($stmt);
    } else {
        // Se a preparação da declaração falhar, redireciona com status 'error'.
        header('Location: adicionarVideo.php?status=error');
        exit();
    }
} else {
    // Se o método da requisição não for POST (por exemplo, GET),
    // redireciona o usuário para a página 'adicionarVideo.php'.
    header('Location: adicionarVideo.php');
    exit();
}
?>