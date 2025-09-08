# API de Usuários

API REST para leitura de usuários, desenvolvida em Laravel como resposta ao desafio de back-end júnior.

## Pré-requisitos

* PHP 8.1 ou superior
* Composer
* Extensão PHP JSON habilitada

## Instalação

1. Clone o repositório e acesse a pasta:

```bash
git clone <url-do-repositorio>
cd <nome-do-diretorio>
```

2. Instale as dependências:

```bash
composer install
```

3. Copie o arquivo de mock para a pasta de armazenamento:

```bash
cp mock-users.json storage/app/
```

4. Inicie o servidor de desenvolvimento:

```bash
php artisan serve
```

## Testando a API

Após iniciar o servidor, a API estará disponível em `http://127.0.0.1:8000`.

Exemplo de como listar os usuários usando cURL:

```bash
curl http://127.0.0.1:8000/api/users
```

Você também pode usar o Postman ou outro cliente HTTP para acessar os endpoints.

### Endpoints principais

* `GET /api/users` – Retorna a lista de usuários.
* `GET /api/users/{id}` – Retorna os detalhes de um usuário específico pelo ID.
