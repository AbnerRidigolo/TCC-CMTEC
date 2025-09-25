<?php
session_start(); // Inicie a sessão

include '../../Controller/conexao.php';
include '../../Model/Chamado.php';

// Defina o fuso horário para São Paulo
date_default_timezone_set('America/Sao_Paulo');

// Suponha que você armazena o codAluno na sessão quando o usuário faz login
$codAluno = $_SESSION['user']['codAluno'] ?? null;

// Verifique se o codAluno está definido
if (!$codAluno) {
    echo "<script>
    alert('Usuário não autenticado.');
    window.location.href = '../../login.html'; // Redirecione para a página de login ou outra página apropriada
  </script>";
    exit;
}

$chamado = new Chamado($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $descricao = $_POST['descricao'] ?? null;
    $codAmbiente = $_POST['local'] ?? null;
    $codEquipamento = $_POST['equipamento'] ?? null;
    
    // Define a data atual no fuso horário de Brasília
    $data = date('Y-m-d H:i:s'); 

    // Exibir os valores recebidos para depuração
    var_dump($_POST);

    // Verificar se todos os campos obrigatórios estão presentes
    if ($descricao && $codAluno && $codAmbiente && $codEquipamento) {
        // Criação do chamado
        if ($chamado->criar($descricao, $codAluno, $codAmbiente, $codEquipamento, $data)) {
            echo "<script>
            alert('Chamado criado com sucesso!');
            window.location.href = '../../usuario/chamados.php'; // Redirecione para a página de chamados ou outra página apropriada
          </script>";
        } else {
            echo "<script>
            alert('Erro ao criar o chamado.');
            window.location.href = '../../usuario/chamados.php'; // Redirecione para a página de chamados ou outra página apropriada
          </script>";
        }
    } else {
        echo "<script>
        alert('Dados incompletos.');
        window.location.href = '../../usuario/chamados.php'; // Redirecione para a página de chamados ou outra página apropriada
      </script>";
    }
} else {
    echo "<script>
    alert('Método HTTP não suportado.');
    window.location.href = '../../usuario/chamados.php'; // Redirecione para a página de chamados ou outra página apropriada
  </script>";
}
?>
