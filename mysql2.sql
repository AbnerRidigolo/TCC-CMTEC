-- Criando o banco de dados
DROP DATABASE IF EXISTS Escola;

CREATE DATABASE Escola;



-- Excluindo o banco de dados Escola se ele existir


-- Usando o banco de dados criado
USE Escola;

-- Criando a tabela Aluno
CREATE TABLE Aluno (
    codAluno INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nome VARCHAR(255) NOT NULL
);

-- Inserindo dados na tabela Aluno
INSERT INTO Aluno (email, senha, nome) VALUES
('aluno1@etec.sp.gov.br', 'senha1', 'Aluno Um'),
('aluno2@etec.sp.gov.br', 'senha2', 'Aluno Dois'),
('aluno3@etec.sp.gov.br', 'senha3', 'Aluno Três'),
('aluno4@etec.sp.gov.br', 'senha4', 'Aluno Quatro'),
('aluno5@etec.sp.gov.br', 'senha5', 'Aluno Cinco'),
('aluno6@etec.sp.gov.br', 'senha6', 'Aluno Seis'),
('aluno7@etec.sp.gov.br', 'senha7', 'Aluno Sete'),
('aluno8@etec.sp.gov.br', 'senha8', 'Aluno Oito'),
('aluno9@etec.sp.gov.br', 'senha9', 'Aluno Nove'),
('aluno10@etec.sp.gov.br', 'senha10', 'Aluno Dez');

-- Criando a tabela Ambiente
CREATE TABLE Ambiente (
    codAmbiente INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL
);

-- Inserindo dados na tabela Ambiente
INSERT INTO Ambiente (descricao) VALUES
('Sala de Aula 101'),
('Laboratório de Informática'),
('Biblioteca'),
('Auditório'),
('Sala de Reuniões'),
('Quadra'),
('Cantina'),
('Laboratório Farmacêutico'),
('Laboratório de Química'),
('Sala de Professores');

-- Criando a tabela Equipamentos
CREATE TABLE Equipamentos (
    codEquipamentos INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL
);

-- Inserindo dados na tabela Equipamentos
INSERT INTO Equipamentos (descricao) VALUES
('Computador'),
('Projetor'),
('Impressora'),
('Scanner'),
('Microfone'),
('Caixa de Som'),
('Mesa de Som'),
('Câmera'),
('Televisão'),
('Ar Condicionado');

CREATE TABLE Status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL
);

INSERT INTO Status (descricao) VALUES
('Aberto'),
('Em Análise'),
('Aguardando Peças'),
('Em Manutenção'),
('Aguardando Aprovação'),
('Aprovado'),
('Rejeitado'),
('Concluído'),
('Cancelado'),
('Reaberto');

-- Criando a tabela Chamado
CREATE TABLE Chamado (
    codChamado INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    codAluno INT NOT NULL,
    data DATE NOT NULL,
    imagem VARCHAR(255),
    codAmbiente INT NOT NULL,
    codEquipamentos INT NOT NULL,
    codStatus INT NOT NULL,
    FOREIGN KEY (codAluno) REFERENCES Aluno(codAluno),
    FOREIGN KEY (codAmbiente) REFERENCES Ambiente(codAmbiente),
    FOREIGN KEY (codEquipamentos) REFERENCES Equipamentos(codEquipamentos)
);

-- Inserindo dados na tabela Chamado
INSERT INTO Chamado (descricao, codAluno, data, imagem, codAmbiente, codEquipamentos, codStatus) VALUES
('Computador não liga', 1, '2024-08-01', 'imagem1.jpg', 1, 1, 1),
('Projetor com defeito', 2, '2024-08-02', 'imagem2.jpg', 2, 2, 2),
('Impressora sem tinta', 3, '2024-08-03', 'imagem3.jpg', 3, 3, 3),
('Scanner não funciona', 4, '2024-08-04', 'imagem4.jpg', 4, 4, 4),
('Microfone com ruído', 5, '2024-08-05', 'imagem5.jpg', 5, 5, 5),
('Caixa de som sem áudio', 6, '2024-08-06', 'imagem6.jpg', 6, 6, 6),
('Mesa de som com defeito', 7, '2024-08-07', 'imagem7.jpg', 7, 7, 7),
('Câmera não grava', 8, '2024-08-08', 'imagem8.jpg', 8, 8, 8),
('Televisão sem sinal', 9, '2024-08-09', 'imagem9.jpg', 9, 9, 9),
('Ar condicionado não liga', 10, '2024-08-10', 'imagem10.jpg', 10, 10, 10);

-- Criando a tabela Funcionario
CREATE TABLE Funcionario (
    codFuncionario INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Inserindo dados na tabela Funcionario
INSERT INTO Funcionario (email, senha) VALUES
('admin', '1234');

-- Selecionar todos os alunos
SELECT * FROM Aluno;

-- Selecionar todos os ambientes
SELECT * FROM Ambiente;

-- Selecionar todos os equipamentos
SELECT * FROM Equipamentos;

-- Selecionar todos os chamados
SELECT * FROM Chamado;

-- Selecionar todos os funcionários
SELECT * FROM Funcionario;

-- Selecionar todos os Status
SELECT * FROM Status;

ALTER TABLE chamado
DROP FOREIGN KEY chamado_ibfk_1;

ALTER TABLE chamado
ADD CONSTRAINT chamado_ibfk_1
FOREIGN KEY (codAluno) REFERENCES aluno(codAluno)
ON DELETE CASCADE;

-- Remover a restrição de chave estrangeira existente
ALTER TABLE Chamado DROP FOREIGN KEY chamado_ibfk_1;
ALTER TABLE Chamado DROP FOREIGN KEY chamado_ibfk_2;
ALTER TABLE Chamado DROP FOREIGN KEY chamado_ibfk_3;

-- Adicionar novamente a chave estrangeira com ON DELETE CASCADE
ALTER TABLE Chamado
ADD CONSTRAINT chamado_ibfk_1 FOREIGN KEY (codAluno) REFERENCES Aluno(codAluno) ON DELETE CASCADE,
ADD CONSTRAINT chamado_ibfk_2 FOREIGN KEY (codAmbiente) REFERENCES Ambiente(codAmbiente) ON DELETE CASCADE,
ADD CONSTRAINT chamado_ibfk_3 FOREIGN KEY (codEquipamentos) REFERENCES Equipamentos(codEquipamentos) ON DELETE CASCADE;

-- Agora as restrições foram adicionadas corretamente.
