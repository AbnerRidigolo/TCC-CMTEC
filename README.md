📘 CMTEC - Sistema de Gestão de Chamados

Sistema completo de controle de chamados desenvolvido com PHP, MySQL, HTML, CSS, JavaScript e Bootstrap. Voltado para instituições ou empresas que precisam gerenciar atendimentos, ambientes e usuários de forma eficiente e com visual moderno.

🧩 Funcionalidades
✅ Autenticação de usuários

🧑‍💻 Perfis diferenciados: Administrador e Usuário

📥 Registro e visualização de chamados

🛠️ Controle de ambientes e manutenção

📊 Dashboard administrativo (com jQuery e Bootstrap)

🔒 Validação de login

📁 Integração com banco de dados MySQL (mysql2.sql)

🗂 Estrutura do Projeto
bash
Copiar
Editar
cmtec/
├── admin/               # Painel administrativo
├── usuario/             # Interface do usuário comum
├── DAO/                 # Data Access Objects (CRUD de entidades)
├── Model/               # Representação de dados em PHP
├── Controller/          # Conexão com banco de dados
├── js/, lib/, scss/     # Recursos front-end
├── login.html           # Tela de login
├── registro.php         # Registro de novos usuários
├── validarLogin.php     # Script de validação de login
├── mysql2.sql           # Script SQL do banco de dados
└── style.css, script.js
🛠 Tecnologias Utilizadas
PHP 7+

MySQL

Bootstrap 5

jQuery

SCSS

JavaScript

HTML5 & CSS3

🧪 Como Executar Localmente
Clone o repositório:

bash
Copiar
Editar
git clone https://github.com/seu-usuario/cmtec.git
Importe o banco mysql2.sql no seu MySQL.

Configure o arquivo Controller/conexao.php com suas credenciais de banco de dados:

php
Copiar
Editar
$conn = new mysqli("localhost", "usuario", "senha", "nome_do_banco");
Inicie um servidor local (por exemplo, XAMPP) e acesse via navegador:

arduino
Copiar
Editar
http://localhost/cmtec/login.html
