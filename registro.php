<?php
include './Controller/conexao.php'; // Verifique o caminho do arquivo

// Obtém os dados do formulário
$nome = $_POST['name'];
$email = $_POST['email'];
$senha = $_POST['password'];

// Valida o email
if (!preg_match('/^[^\s@]+@etec\.sp\.gov\.br$/', $email)) {
    echo "<script>
    alert('O e-mail deve ser do domínio @etec.sp.gov.br.');
    window.location.href = 'login.html';
  </script>";
    exit;
}

// Verifica se o email já existe no banco de dados
$sql = "SELECT * FROM Aluno WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "<script>
    alert('O e-mail já está cadastrado.');
    window.location.href = 'login.html';
  </script>";
    exit;
}

// Criptografa a senha
$senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

// Insere no banco de dados
$sql = "INSERT INTO Aluno (nome, email, senha) VALUES (:nome, :email, :senha)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senhaCriptografada);

if ($stmt->execute()) {
    echo "<script>
    alert('Conta criada com sucesso!');
    window.location.href = 'login.html';
  </script>";
} else {
    echo "<script>
    alert('Falha ao criar conta.');
    window.location.href = 'login.html';
  </script>";
}
?>
