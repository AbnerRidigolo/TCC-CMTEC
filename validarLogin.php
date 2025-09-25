<?php
session_start();
include './Controller/conexao.php'; // Verifique o caminho do arquivo

// Obtém os dados do formulário
$usuario = $_POST['username'];
$senha = $_POST['password'];

// Consulta o banco de dados
$sql = "SELECT * FROM Aluno WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $usuario);
$stmt->execute();
$aluno = $stmt->fetch(PDO::FETCH_ASSOC);


if ($aluno && $senha === $aluno['senha']) {
    $_SESSION['token'] = bin2hex(random_bytes(16)) . '_aluno';
    $_SESSION['user'] = [
        'nome' => $aluno['nome'],
        'email' => $aluno['email'],
        'codAluno' => $aluno['codAluno']
    ];
    header('Location: usuario/index.php'); // Redireciona para a página admin após login
    exit;
} else {
    echo "<script>
    alert('Nome de usuário ou senha incorretos.');
    window.location.href = 'login.html';
  </script>";
}
// Verifica se o usuário existe e a senha está correta
if ($aluno && password_verify($senha, $aluno['senha'])) {
    $_SESSION['token'] = bin2hex(random_bytes(16)) . '_aluno';
    $_SESSION['user'] = [
        'nome' => $aluno['nome'],
        'email' => $aluno['email'],
        'codAluno' => $aluno['codAluno']
    ];
    header('Location: usuario/index.php'); // Redireciona para a página do aluno após login
    exit;
}

?>




