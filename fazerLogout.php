<?php
// Inicia a sessão. É necessário chamar session_start() em todas as páginas que usam sessões.
session_start();

// Limpa todas as variáveis de sessão. Isso efetivamente "desassocia" os dados da sessão atual.
$_SESSION = array();

// Remove todas as variáveis de sessão. Esta função esvazia o array $_SESSION.
session_unset();

// Destroi a sessão. Isso remove os dados da sessão do servidor e o ID da sessão do navegador.
// Uma vez que a sessão é destruída, o usuário não estará mais logado.
session_destroy();

// Redireciona o usuário para a página de login ('fazerLogin.php').
// Isso garante que após o logout, o usuário seja levado para um local seguro e apropriado.
header('Location: fazerLogin.php');
// O exit() é crucial para garantir que o script seja encerrado imediatamente após o redirecionamento.
// Isso impede que qualquer código adicional na página seja executado, o que poderia levar a comportamento inesperado
// ou a vazamento de informações.
exit();
?>