<?php
include '../../Controller/conexao.php';
include '../../Model/Aluno.php';

$aluno = new Aluno($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $codAluno = $data['codAluno'] ?? null;
    $email = $data['email'] ?? null;
    $senha = $data['senha'] ?? null;
    $nome = $data['nome'] ?? null;

    if ($codAluno && $email && $senha && $nome && $aluno->atualizar($codAluno, $email, $senha, $nome)) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Aluno atualizado com sucesso!']);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Falha ao atualizar aluno.']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Método HTTP não suportado.']);
}
?>
