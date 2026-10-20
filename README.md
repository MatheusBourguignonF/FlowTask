# TaskMaster

Sistema de gerenciamento de tarefas desenvolvido em PHP, com MySQL, para organizar atividades em uma agenda semanal.

## Tecnologias utilizadas

- PHP
- MySQL / MariaDB
- HTML
- CSS
- JavaScript
- XAMPP
- Git e GitHub

## Funcionalidades

- Cadastro de usuários
- Login e logout
- Autenticação por sessão
- Criação de tarefas
- Exibição de tarefas organizadas por dia e horário
- Exclusão de tarefas
- Armazenamento das tarefas no banco de dados por usuário

## Pré-requisitos

Antes de executar o projeto, instale:

- [XAMPP](https://www.apachefriends.org/pt_br/index.html)
- [Visual Studio Code](https://code.visualstudio.com/)
- [Git](https://git-scm.com/)

## 1. Clonar o projeto

Abra o terminal e execute:

```bash
git clone URL_DO_REPOSITORIO
```

Entre na pasta do projeto:

```bash
cd TaskMaster
```

Substitua `URL_DO_REPOSITORIO` pelo endereço HTTPS do repositório no GitHub.

## 2. Configurar o ambiente local

1. Abra o XAMPP Control Panel.
2. Inicie os módulos **Apache** e **MySQL**.
3. Coloque a pasta do projeto dentro do diretório `htdocs` do XAMPP.

O caminho deverá ficar semelhante a:

```text
C:\xampp\htdocs\TaskMaster
```

Se o projeto estiver dentro de outra pasta, mantenha a estrutura original e ajuste o endereço local conforme necessário.

## 3. Criar e importar o banco de dados

1. Acesse [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
2. Crie um banco de dados chamado `taskmaster`.
3. Selecione o banco criado.
4. Clique na aba **Importar**.
5. Selecione o arquivo `database/taskmaster.sql`.
6. Execute a importação.

Após a importação, confira se as tabelas necessárias foram criadas.

> O arquivo SQL precisa estar presente no repositório. Caso ainda não esteja, exporte o banco original pelo phpMyAdmin antes de executar estas etapas.

## 4. Configurar a conexão com o banco

Abra o arquivo `connection.php` e confira as configurações:

```php
<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "taskmaster";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
```

Os valores acima correspondem a uma configuração local comum do XAMPP. Se o MySQL estiver configurado com outra senha, atualize a variável `$pass`.

**Importante:** não utilize essas credenciais sem verificar a configuração do seu ambiente.

## 5. Executar o projeto

Com Apache e MySQL iniciados, abra o navegador e acesse:

```text
http://localhost/TaskMaster/
```

Se os arquivos estiverem dentro de uma subpasta, ajuste o endereço para corresponder ao caminho real.

## Solução de problemas

### Erro de conexão com o banco de dados

- Confirme se o MySQL está iniciado no XAMPP.
- Confira o nome do banco de dados.
- Verifique usuário e senha no `connection.php`.
- Confirme se as tabelas foram importadas corretamente.

### Página não encontrada

- Verifique se a pasta está dentro de `htdocs`.
- Confira o nome da pasta do projeto.
- Acesse o projeto pelo `localhost`, não abrindo os arquivos PHP diretamente.

### Cadastro ou login não funciona

- Confirme se as tabelas `users` e `tasks` existem.
- Confira se a estrutura das colunas corresponde às consultas SQL do projeto.
- Verifique os erros apresentados pelo PHP e pelo banco de dados.
