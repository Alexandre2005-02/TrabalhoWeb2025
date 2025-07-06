<?php
// Inclui o cabeçalho da página (geralmente contém HTML, CSS e scripts).
include "header.php";
// Inclui o arquivo de conexão com o banco de dados.
include "conexaoBd.php";

// Verifica se o método da requisição HTTP é POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inicializa variáveis para os dados do usuário e uma flag de erro.
    $nomeUsuario = $emailUsuario = $senhaUsuario = $confirmarSenhaUsuario = $tipoUsuario = "";
    $erroPreenchimento = false; // Flag para indicar se houve algum erro de validação.

    // --- Validação do campo NOME ---
    if (empty($_POST["nomeUsuario"])) {
        // Exibe uma mensagem de alerta se o campo nome estiver vazio.
        echo "<div class='alert alert-warning text-center'>
            O campo <strong>NOME</strong> é obrigatório!
        </div>";
        $erroPreenchimento = true; // Define a flag de erro como verdadeira.
    } else {
        // Limpa e valida a entrada do nome do usuário.
        $nomeUsuario = testar_entrada($_POST["nomeUsuario"]);
        // Verifica se o nome contém apenas letras e espaços (incluindo caracteres acentuados com '/u' para UTF-8).
        if (!preg_match('/^[\p{L} ]+$/u', $nomeUsuario)) {
            echo "<div class='alert alert-warning text-center'>
                    O <strong>NOME</strong> deve conter apenas letras e espaços!
                </div>";
            $erroPreenchimento = true;
        }
    }

    // --- Validação do campo EMAIL ---
    if (empty($_POST["emailUsuario"])) {
        // Exibe uma mensagem de alerta se o campo email estiver vazio.
        echo "<div class='alert alert-warning text-center'>
            O campo <strong>EMAIL</strong> é obrigatório!
        </div>";
        $erroPreenchimento = true;
    } else {
        // Limpa e valida a entrada do email do usuário.
        $emailUsuario = testar_entrada($_POST["emailUsuario"]);
        // Valida o formato do email usando FILTER_VALIDATE_EMAIL.
        if (!filter_var($emailUsuario, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='alert alert-warning text-center'>
                    O <strong>EMAIL</strong> informado não é válido!
                </div>";
            $erroPreenchimento = true;
        }
    }

    // --- Validação do campo TIPO DE USUÁRIO ---
    if (empty($_POST["usuario_tipo"])) {
        // Exibe uma mensagem de alerta se o campo tipo de usuário estiver vazio.
        echo "<div class='alert alert-warning text-center'>
            O campo <strong>TIPO DE USUÁRIO</strong> é obrigatório!
        </div>";
        $erroPreenchimento = true;
    } else {
        // Limpa e valida a entrada do tipo de usuário.
        $tipoUsuario = testar_entrada($_POST["usuario_tipo"]);
        // Verifica se o tipo de usuário é 'Tutor' ou 'Aprendiz'.
        if (!in_array($tipoUsuario, ['Tutor', 'Aprendiz'])) {
            echo "<div class='alert alert-warning text-center'>
                    O <strong>TIPO DE USUÁRIO</strong> é inválido!
                </div>";
            $erroPreenchimento = true;
        }
    }

    // --- Validação dos campos de SENHA ---
    if (empty($_POST["senha"]) || empty($_POST["confirma_senha"])) {
        // Exibe uma mensagem de alerta se os campos de senha estiverem vazios.
        echo "<div class='alert alert-warning text-center'>
            Os campos de <strong>SENHA</strong> são obrigatórios!
        </div>";
        $erroPreenchimento = true;
    } else {
        // Coleta as senhas digitadas.
        $senhaUsuario = $_POST["senha"];
        $confirmarSenhaUsuario = $_POST["confirma_senha"];

        // Verifica se as senhas coincidem.
        if ($senhaUsuario != $confirmarSenhaUsuario) {
            echo "<div class='alert alert-warning text-center'>
                As <strong>SENHAS</strong> digitadas não coincidem!
            </div>";
            $erroPreenchimento = true;
        }
        // Verifica se a senha tem pelo menos 4 caracteres.
        if (strlen($senhaUsuario) < 4) {
            echo "<div class='alert alert-warning text-center'>
                A <strong>SENHA</strong> deve ter pelo menos 4 caracteres!
            </div>";
            $erroPreenchimento = true;
        }
    }
    
    // Se não houver nenhum erro de preenchimento após todas as validações.
    if (!$erroPreenchimento) {
        // Gera o hash da senha usando o algoritmo padrão (PASSWORD_DEFAULT).
        $senhaHash = password_hash($senhaUsuario, PASSWORD_DEFAULT);
        // Prepara a query SQL para inserir o novo usuário no banco de dados.
        $inserirUsuario = "INSERT INTO Usuarios (nomeUsuario, emailUsuario, senhaUsuario, tipoUsuario) VALUES (?, ?, ?, ?)";
        // Prepara a declaração SQL usando a conexão com o banco de dados.
        $stmt = mysqli_prepare($conn, $inserirUsuario);

        // Verifica se a preparação da declaração foi bem-sucedida.
        if ($stmt) {
            // Vincula os parâmetros à declaração preparada.
            // 'ssss' indica que todos os quatro parâmetros são strings.
            mysqli_stmt_bind_param($stmt, 'ssss', $nomeUsuario, $emailUsuario, $senhaHash, $tipoUsuario);
            
            // Executa a declaração preparada.
            if (mysqli_stmt_execute($stmt)) {
                // Exibe mensagem de sucesso e um link para a página de login.
                echo "<div class='alert alert-success text-center'>
                        Usuário <strong>$nomeUsuario</strong> cadastrado com sucesso!
                        <a href='fazerLogin.php' class='alert-link'>Faça seu login aqui!</a>
                    </div>";
                // Exibe os dados cadastrados em um card para o usuário.
                echo "<div class='container mt-5 d-flex justify-content-center'>
                        <div class='card bg-dark text-white shadow p-4' style='width: 100%; max-width: 500px;'>
                            <h4 class='mb-4 text-center'>Dados Cadastrados</h4>
                            <table class='table table-dark table-striped'>
                                <tr>
                                    <th>NOME</th>
                                    <td>$nomeUsuario</td>
                                </tr>
                                <tr>
                                    <th>EMAIL</th>
                                    <td>$emailUsuario</td>
                                </tr>
                                <tr>
                                    <th>TIPO DE USUÁRIO</th>
                                    <td>$tipoUsuario</td>
                                </tr>
                            </table>
                        </div>
                    </div>";
            } 
            else {
                // Exibe mensagem de erro se a inserção falhar.
                echo "<div class='alert alert-danger text-center'>
                        Erro ao tentar inserir dados do <strong>Usuário</strong> na base de dados!
                        Detalhes: " . mysqli_error($conn) . "
                    </div>";
            }
            // Fecha a declaração.
            mysqli_stmt_close($stmt);
        } 
        else {
            // Exibe mensagem de erro se a preparação da consulta falhar.
            echo "<div class='alert alert-danger text-center'>
                    Erro na preparação da consulta: " . mysqli_error($conn) . "
                </div>";
        }
    }
} 
else {
    // Se a requisição não for POST, redireciona para a página de cadastro de usuário.
    header("location:cadastrarUsuario.php");
    exit();
}

// Função para limpar e validar dados de entrada.
function testar_entrada($dado) {
    $dado = trim($dado);          // Remove espaços em branco do início e do fim.
    $dado = stripslashes($dado);  // Remove barras invertidas.
    $dado = htmlspecialchars($dado); // Converte caracteres especiais em entidades HTML para evitar XSS.
    return $dado; // Retorna o dado limpo.
}
?>
<?php 
// Inclui o rodapé da página.
include "footer.php"; 
?>