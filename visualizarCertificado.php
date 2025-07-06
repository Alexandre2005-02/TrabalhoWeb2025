<?php
// Define o fuso horário padrão para São Paulo, Brasil.
date_default_timezone_set('America/Sao_Paulo');

// Inclui o arquivo de conexão com o banco de dados.
include('conexaoBd.php');

// Inicia a sessão PHP.
session_start();

// Obtém o código do certificado da URL, usando o operador null coalescing (??) para definir como string vazia se não estiver presente.
$codigoCertificado = $_GET['codigo'] ?? '';

// Inicializa a variável $certificado como nula.
$certificado = null;

// Verifica se o código do certificado não está vazio.
if (!empty($codigoCertificado)) {
    // Query SQL para buscar os detalhes do certificado, unindo as tabelas Certificados, Usuarios (para aprendiz e tutor) e VideosTreinamento.
    $sqlBuscarCertificado = "SELECT c.idCertificado, c.dataEmissao, c.codigoCertificado,
                                  u_ap.nomeUsuario AS nomeAprendiz, u_ap.emailUsuario AS emailAprendiz,
                                  vt.tituloVideo, vt.descricaoVideo,
                                  u_tut.nomeUsuario AS nomeTutor
                           FROM Certificados c
                           JOIN Usuarios u_ap ON c.idUsuario = u_ap.idUsuario
                           JOIN VideosTreinamento vt ON c.idTreinamento = vt.idVideo
                           JOIN Usuarios u_tut ON c.idTutorEmissor = u_tut.idUsuario
                           WHERE c.codigoCertificado = ?";
    
    // Prepara a declaração SQL para evitar injeção de SQL.
    $stmt = mysqli_prepare($conn, $sqlBuscarCertificado);

    // Verifica se a declaração foi preparada com sucesso.
    if ($stmt) {
        // Vincula o parâmetro 's' (string) ao placeholder (?) na query.
        mysqli_stmt_bind_param($stmt, 's', $codigoCertificado);
        // Executa a declaração preparada.
        mysqli_stmt_execute($stmt);
        // Obtém o resultado da execução da declaração.
        $resultado = mysqli_stmt_get_result($stmt);
        // Busca a linha do resultado como um array associativo.
        $certificado = mysqli_fetch_assoc($resultado);
        // Fecha a declaração.
        mysqli_stmt_close($stmt);
    }
}
// Fecha a conexão com o banco de dados.
mysqli_close($conn);

// Inclui o arquivo de cabeçalho (provavelmente contém elementos HTML comuns).
include('header.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado - <?php echo $certificado ? htmlspecialchars($certificado['tituloVideo']) : 'Não Encontrado'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="css/styles.css" rel="stylesheet">
    <style>
        /* Estilos CSS específicos para esta página. */
        body {
            background-color: #f8f9fa; /* Cor de fundo do corpo. */
        }
        .certificate-container {
            font-family: 'Arial', sans-serif; /* Fonte. */
            background: linear-gradient(to right, #dc3545, #6c757d); /* Gradiente de fundo. */
            padding: 50px; /* Preenchimento interno. */
            margin: 50px auto; /* Margem externa (centraliza horizontalmente). */
            max-width: 900px; /* Largura máxima. */
            border-radius: 15px; /* Bordas arredondadas. */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* Sombra. */
            color: #fff; /* Cor do texto. */
            position: relative; /* Posição relativa para elementos internos. */
            overflow: hidden; /* Esconde conteúdo que transborda. */
            border: 10px solid #dc3545; /* Borda. */
        }
        .certificate-inner {
            background-color: rgba(255, 255, 255, 0.1); /* Cor de fundo interna com transparência. */
            padding: 40px; /* Preenchimento interno. */
            border-radius: 10px; /* Bordas arredondadas. */
            text-align: center; /* Alinhamento do texto. */
        }
        .certificate-header {
            font-size: 2.5em; /* Tamanho da fonte do cabeçalho. */
            font-weight: bold; /* Negrito. */
            margin-bottom: 20px; /* Margem inferior. */
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3); /* Sombra do texto. */
        }
        .certificate-subtitle {
            font-size: 1.5em; /* Tamanho da fonte do subtítulo. */
            margin-bottom: 30px; /* Margem inferior. */
        }
        .certificate-name {
            font-size: 3.5em; /* Tamanho da fonte do nome. */
            font-family: 'Brush Script MT', cursive; /* Fonte específica para o nome. */
            margin: 30px 0; /* Margem superior e inferior. */
            color:rgb(218, 255, 7); /* Cor do texto (amarelo esverdeado). */
            text-shadow: 3px 3px 6px rgba(0,0,0,0.5); /* Sombra do texto. */
        }
        .certificate-body p {
            font-size: 1.2em; /* Tamanho da fonte do parágrafo do corpo. */
            line-height: 1.6; /* Altura da linha. */
        }
        .certificate-signature {
            margin-top: 50px; /* Margem superior. */
            display: flex; /* Usa flexbox para layout. */
            justify-content: space-around; /* Distribui os itens com espaço entre eles. */
            align-items: flex-end; /* Alinha os itens na parte inferior. */
            font-size: 1.1em; /* Tamanho da fonte. */
        }
        .signature-block {
            text-align: center; /* Alinhamento do texto. */
            border-top: 1px solid #ccc; /* Borda superior. */
            padding-top: 10px; /* Preenchimento superior. */
            flex-grow: 1; /* Permite que o item cresça para preencher o espaço disponível. */
            margin: 0 20px; /* Margem horizontal. */
        }
        .certificate-code-display { 
            margin-top: 40px; /* Margem superior. */
            font-size: 0.9em; /* Tamanho da fonte. */
            color: rgba(255, 255, 255, 0.7); /* Cor do texto com transparência. */
        }
        .print-button-container {
            text-align: center; /* Alinhamento do texto. */
            margin-top: 20px; /* Margem superior. */
        }
        /* Estilos específicos para impressão. */
        @media print {
            body {
                background-color: #fff; /* Fundo branco na impressão. */
                margin: 0; /* Sem margem. */
            }
            .certificate-container {
                box-shadow: none; /* Sem sombra na impressão. */
                margin: 0; /* Sem margem. */
                padding: 20px; /* Preenchimento. */
                border: 5px solid #dc3545; /* Borda. */
                background: none; /* Sem fundo. */
                color: #000; /* Cor do texto preta. */
            }
            .certificate-inner {
                background-color: #fff; /* Fundo branco. */
                color: #000; /* Cor do texto preta. */
            }
            .certificate-name {
                color: #dc3545; /* Cor do nome. */
                -webkit-print-color-adjust: exact; /* Força a impressão da cor exata em WebKit. */
            }
            .print-button-container {
                display: none; /* Esconde os botões na impressão. */
            }
            @page {
                margin: 1cm; /* Margem da página. */
            }
        }
    </style>
</head>
<body>

    <?php if ($certificado) : // Verifica se o certificado foi encontrado. ?>
        <div class="certificate-container">
            <div class="certificate-inner">
                <h1 class="certificate-header">CERTIFICADO DE CONCLUSÃO</h1>
                <p class="certificate-subtitle">É com grande satisfação que certificamos que</p>
                <h2 class="certificate-name"><?php echo htmlspecialchars($certificado['nomeAprendiz']); ?></h2>
                <div class="certificate-body">
                    <p>Concluiu com êxito o treinamento:</p>
                    <h3>"<?php echo htmlspecialchars($certificado['tituloVideo']); ?>"</h3>
                    <p>Ministrado na plataforma: Brigadista Virtual.</p>
                    <?php
                        // Cria um objeto DateTime a partir da data de emissão do certificado.
                        $dataEmissao = new DateTime($certificado['dataEmissao']);

                        // Arrays para tradução dos meses de inglês para português.
                        $mesesIngles = array(
                            'January', 'February', 'March', 'April', 'May', 'June',
                            'July', 'August', 'September', 'October', 'November', 'December'
                        );
                        $mesesPortugues = array(
                            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                        );

                        // Formata a data de emissão e substitui os nomes dos meses para português.
                        $dataEmissaoFormatada = str_replace(
                            $mesesIngles,
                            $mesesPortugues,
                            $dataEmissao->format('d \d\e F \d\e Y')
                        );
                    ?>
                    <p>Emitido em: <?php echo $dataEmissaoFormatada; ?></p>
                </div>
                <div class="certificate-signature">
                    <div class="signature-block">
                        <p>___________________________________</p>
                        <p><strong><?php echo htmlspecialchars($certificado['nomeTutor']); ?></strong></p>
                        <p>Tutor Responsável</p>
                    </div>
                </div>
                <p class="certificate-code-display">Código de Verificação: <strong><?php echo htmlspecialchars($certificado['codigoCertificado']); ?></strong></p>
            </div>
        </div>
        <div class="print-button-container">
            <button onclick="window.print()" class="btn btn-primary btn-lg"><i class="fas fa-print me-2"></i>Imprimir Certificado</button>
            <a href="index.php" class="btn btn-secondary btn-lg ms-3"><i class="fas fa-arrow-left me-2"></i>Voltar</a>
        </div>
    <?php else : // Caso o certificado não seja encontrado. ?>
        <div class="container text-center mt-5">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Certificado Não Encontrado!</h4>
                <p>O código de certificado fornecido não corresponde a nenhum certificado em nossa base de dados ou está inválido.</p>
                <hr>
                <p class="mb-0">Por favor, verifique o código ou entre em contato com o suporte.</p>
            </div>
            <a href="index.php" class="btn btn-primary mt-3">Voltar para o Início</a>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>