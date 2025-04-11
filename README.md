# Microsserviços com Docker

Desafio prático da DIO utilizando Docker, PHP, MySQL e Nginx.  
O projeto simula uma arquitetura de microsserviços com balanceamento de carga e inserção automática de dados no banco de dados.

Este é um fork do repositório [toshiro-shibakita](https://github.com/denilsonbonatti/toshiro-shibakita) do Denilson Bonatti, com melhorias implementadas e estrutura otimizada para execução local em ambiente de produção via Docker Compose.

## 🐳 Stack Dockerizada

O ambiente é composto por **três containers**:

- `php` – executa PHP 8.1 via FPM (3 instâncias são criadas)
- `nginx` – serve a aplicação e encaminha as requisições PHP usando FastCGI
- `mysql` – banco de dados da aplicação

## ⚙️ Principais Alterações e Funcionalidades

- Utilização do **PHP 8.1 FPM** para execução das aplicações PHP.
- **NGINX configurado com FastCGI**, já que o PHP-FPM não possui suporte nativo a requisições HTTP.
- Adição completa do **Docker Compose**, com estrutura de pastas organizada:
  - `Dockerfile` para o container PHP
  - `docker-compose.yml` para orquestração
  - `db/banco.sql` para inicialização automática do banco
- Utilização de **variáveis de ambiente** para configuração segura e flexível (credenciais do MySQL, nome do banco, etc.).
- Arquivo `tabela.php` responsável por exibir os dados dinamicamente do banco.
- Adicionado **botão** que apaga todos os registros do banco.

## 📁 Estrutura do Projeto

```bash
├── docker-compose.yml
├── .gitignore
├── php/
│   ├── dockerfile
│   ├── index.php # Insere os dados
│   └── tabela.php # Exibe os dados através de uma tabela
├── nginx/
│   ├── dockerfile
│   └── nginx.conf
├── db/
│   └── banco.sql # Script do banco
└── README.md

```

## 🚀 Como executar o projeto localmente

Siga os passos abaixo para rodar o projeto localmente:

### 1️⃣ Clone o repositório

```bash
git clone https://github.com/gabriel-mkv/docker-microsservices.git
cd docker-microsservices
```
### 2️⃣ Crie o arquivo .env

Crie um arquivo .env na raiz do projeto com as seguintes variáveis:

```bash
DB_HOST=db
DB_USER=user
DB_PASSWORD=secret
DB_NAME=mydatabase
```
>‌💡 Você pode ajustar os valores conforme necessário, mas mantenha DB_HOST=db para compatibilidade com o Docker Compose.

### 3️⃣ Suba os containers com Docker Compose

```bash
docker compose up --build
```

### 4️⃣ Inserir dados no banco

Acesse no navegador:

```bash
http://localhost:4500
```

Esse endpoint aciona o script que insere dados automaticamente no banco.

### 5️⃣ Visualizar os registros

Acesse:

```bash
http://localhost:4500/tabela.php
```

Aqui você poderá visualizar os dados que foram inseridos.

## 🧰 Tecnologias utilizadas
 - Docker
 - Docker Compose
 - PHP
 - MySQL
 - Nginx

## 📄 Licença

Este projeto é um fork e segue os termos de uso do repositório original.
Créditos ao [Denilson Bonatti](https://github.com/denilsonbonatti) pela base do projeto.

Link do repositório original:‌ https://github.com/denilsonbonatti/toshiro-shibakita.git