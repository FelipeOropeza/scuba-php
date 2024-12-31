# 7 Days de PHP

Bem-vindo ao "7 Days de PHP"! Este é um desafio de programação em que você vai simular uma demanda do mundo real. Durante 7 dias, você irá implementar funcionalidades essenciais como login, cadastro, validação de e-mail, recuperação de senha e refatoração do ScubaPHP para algo mais moderno. O objetivo é trabalhar com temas como criptografia, envio de e-mails, sessões, manipulação de arquivos e outros conceitos fundamentais de desenvolvimento PHP.

## Objetivos do Projeto

Durante os 7 dias de desenvolvimento, você vai aprender e implementar:

- **Criptografia**: Utilizar técnicas para garantir a segurança dos dados.
- **Envio de E-mails**: Implementação de e-mails de confirmação, recuperação de senha e mais.
- **Sessões e Autenticação**: Implementar login, cadastro e gerenciamento de sessão.
- **Validação de Dados**: Garantir que os dados inseridos pelos usuários sejam válidos.
- **Manipulação de Arquivos**: Processar arquivos de forma eficiente e segura.

## Como Funciona

Cada dia será focado em uma funcionalidade específica. A cada dia, você vai adicionar ou refatorar partes do código, culminando em um sistema completo ao final de 7 dias.

---

## **Dia 1: Refatoração e Baixo Acoplamento**

No primeiro dia, você fará o download da ferramenta que será usada durante o desafio. O foco será refatorar pequenos trechos de código, garantindo que o sistema tenha **baixo acoplamento** e **alta coesão**.

### Tarefas:
- Baixar a ferramenta PHP.
- Refatorar o código existente para melhorar a estrutura do sistema.

---

## **Dia 2: Salvar Dados Sem Banco de Dados**

Neste dia, você irá trabalhar no processo de cadastro de usuários, criando um sistema de armazenamento dos dados em arquivos locais, sem utilizar banco de dados.

### Tarefas:
- Criar funções para salvar os dados enviados pelo usuário no formulário de registro.
- Armazenar dados em arquivos locais (ex.: JSON ou arquivos de texto).

---

## **Dia 3: Validação de Dados de Formulário**

O objetivo neste dia é validar os dados do usuário, garantindo que a entrada seja correta. Se houver erros no formulário, o sistema deve retroceder para a tela anterior, exibindo mensagens de erro.

### Tarefas:
- Validar os dados inseridos pelo usuário no formulário de registro.
- Implementar lógica para retroceder para a tela anterior em caso de erro.

---

## **Dia 4: Envio de E-mail de Confirmação**

No desafio de hoje, você vai integrar a funcionalidade de envio de e-mail para os usuários. O e-mail de confirmação será enviado após o cadastro, utilizando um token criptografado com SSL.

### Tarefas:
- Criar uma conta de e-mail para enviar mensagens.
- Enviar e-mail de confirmação de cadastro.
- Gerar e armazenar um token criptografado para o usuário.

---

## **Dia 5: Recuperação de Dados Criptografados e Login**

Neste dia, você vai recuperar os dados criptografados utilizando SSL. Além disso, permitirá que os usuários façam login no sistema após a ativação da conta.

### Tarefas:
- Recuperar e verificar os dados criptografados.
- Implementar a funcionalidade de login no ScubaPHP após a ativação da conta.

---

## **Dia 6: Página Inicial e Funcionalidade de Logout**

No sexto dia, você vai gerar dinamicamente a página inicial com as informações do usuário logado. Além disso, permitirá que o usuário delete sua conta e adicione a funcionalidade de logout.

### Tarefas:
- Criar a página inicial personalizada para o usuário logado.
- Implementar a funcionalidade de logout.
- Permitir que o usuário delete seus dados da aplicação.

---

## **Dia 7: Alteração de Senha**

No último dia, você vai finalizar o sistema implementando a funcionalidade de alteração de senha. Duas novas rotas serão criadas para tratar o processo de alteração de senha de forma segura.

### Tarefas:
- Criar rotas não autenticadas para a alteração de senha.
- Garantir que as alterações de senha sejam feitas de forma segura e eficaz.

---

## Requisitos

Para executar este projeto, você vai precisar de:

- PHP 7.4 ou superior.
- Servidor web (ex.: Apache, Nginx).
- Ferramenta para enviar e-mails (ex.: PHPMailer ou similar).
- Editor de texto ou IDE (ex.: Visual Studio Code, PhpStorm).
- Biblioteca de criptografia (ex.: OpenSSL).
  
---

## Como Rodar

1. Clone este repositório:
   ```bash
   git clone https://github.com/seu-usuario/7-days-de-php.git
