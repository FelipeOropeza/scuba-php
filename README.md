# 7 Days de PHP

Este é um desafio de desenvolvimento em PHP no qual você será responsável por implementar funcionalidades essenciais de um sistema de autenticação e gerenciamento de usuários ao longo de **7 dias**. O desafio inclui a criação de funcionalidades como login, cadastro, validação de e-mail, recuperação de senha e a refatoração de um sistema existente para algo mais moderno e escalável. Vamos trabalhar com criptografia, envio de e-mails, manipulação de arquivos, sessões e muito mais.

---

## Objetivo do Desafio

A cada dia, você irá implementar ou refatorar uma funcionalidade específica, utilizando PHP e o framework que será fornecido. Ao final dos 7 dias, você terá desenvolvido um sistema de autenticação completo, com todas as funcionalidades necessárias.

---

## Cronograma do Desafio

### **Dia 1: Refatoração e Baixo Acoplamento**
- **Objetivo**: Baixar o framework e refatorar o código existente, visando reduzir o acoplamento e aumentar a coesão.
- **Tarefas**:
  - Baixe o framework PHP fornecido.
  - Refatore o código para melhorar a estrutura do projeto, buscando um baixo acoplamento e alta coesão.
  - Organize o código para facilitar futuras manutenções.

### **Dia 2: Salvar Dados Sem Banco de Dados**
- **Objetivo**: Criar um sistema de registro de usuários sem usar banco de dados, utilizando arquivos locais para armazenar os dados.
- **Tarefas**:
  - Crie funções para salvar dados de registro (nome, e-mail, senha) em arquivos locais (por exemplo, em arquivos JSON ou TXT).
  - Não use banco de dados para esta parte do sistema.
  - Assegure-se de que os dados são salvos de maneira organizada e segura.

### **Dia 3: Validação de Dados de Formulário**
- **Objetivo**: Validar os dados inseridos pelos usuários e exibir mensagens de erro caso haja problemas.
- **Tarefas**:
  - Implemente validações para o formulário de registro, como:
    - Verificar se o e-mail é válido.
    - Verificar se a senha atende aos requisitos mínimos de segurança.
    - Garantir que os campos obrigatórios não sejam deixados em branco.
  - Se houver erro, retroceda a requisição para a tela anterior e exiba as mensagens de erro.

### **Dia 4: Envio de E-mail de Confirmação**
- **Objetivo**: Enviar um e-mail de confirmação para o usuário após o cadastro.
- **Tarefas**:
  - Configure um servidor de e-mail (usando ferramentas como PHPMailer ou SMTP).
  - Envie um e-mail de confirmação de cadastro para o novo usuário com um link para ativação.
  - Utilize criptografia SSL para proteger os dados sensíveis.

### **Dia 5: Recuperação de Dados Criptografados e Login**
- **Objetivo**: Recuperar e verificar os dados criptografados e permitir que o usuário faça login após a ativação.
- **Tarefas**:
  - Criptografe as informações do usuário (como senha) utilizando técnicas como hash e SSL.
  - Implemente a funcionalidade de login, permitindo que o usuário entre no sistema após ativar sua conta através do link no e-mail de confirmação.
  - Garanta que a senha nunca seja armazenada em texto simples.

### **Dia 6: Página Inicial e Funcionalidade de Logout**
- **Objetivo**: Criar a página inicial do usuário logado e permitir o logout.
- **Tarefas**:
  - Crie uma página inicial dinâmica que mostre informações do usuário logado, como nome e e-mail.
  - Implemente a funcionalidade de logout, que deve destruir a sessão do usuário e redirecioná-lo para a página de login.
  - Permita que o usuário delete sua conta e todos os dados associados.

### **Dia 7: Alteração de Senha**
- **Objetivo**: Implementar o fluxo para alteração de senha, criando rotas para tratar essa ação de forma segura.
- **Tarefas**:
  - Crie duas rotas não autenticadas para que o usuário possa alterar sua senha:
    1. Uma rota para solicitar a alteração (gerar um token para a verificação).
    2. Uma rota para efetivar a alteração da senha, validando o token e garantindo que a senha nova seja segura.
  - Assegure-se de que todo o fluxo de alteração de senha seja seguro, utilizando criptografia.
