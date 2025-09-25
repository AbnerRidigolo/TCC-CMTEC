<?php
class Chamado {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Listar todos os Chamados para um aluno específico
    public function listarPorAluno($codAluno) {
        $sql = "SELECT * FROM Chamado WHERE codAluno = :codAluno";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':codAluno', $codAluno, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Criar um novo Chamado
    public function criar($descricao, $codAluno, $codAmbiente, $codEquipamento, $data) {
        $sql = "INSERT INTO Chamado (descricao, codAluno, codAmbiente, codEquipamentos, data) 
                VALUES (:descricao, :codAluno, :codAmbiente, :codEquipamentos, :data)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':codAluno', $codAluno, PDO::PARAM_INT);
        $stmt->bindParam(':codAmbiente', $codAmbiente, PDO::PARAM_INT);
        $stmt->bindParam(':codEquipamentos', $codEquipamento, PDO::PARAM_INT);
        $stmt->bindParam(':data', $data);

        return $stmt->execute();
    }
}

?>
