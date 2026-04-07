# Sistema de Agendamentos

Este é um sistema de agendamentos completo, desenvolvido com **Laravel 13**, **Inertia.js** e **React**. A aplicação permite que usuários se cadastrem, façam login, visualizem serviços disponíveis e realizem agendamentos tanto via interface web quanto via API REST.

## 🚀 Tecnologias Utilizadas

- **Backend:** Laravel 13
- **Frontend:** React (via Inertia.js)
- **Estilização:** Tailwind CSS
- **Banco de Dados:** MySQL
- **Testes:** Pest PHP
- **Containerização:** Docker & Docker Compose

---

## 🧠 Decisões Técnicas

Este projeto foi desenvolvido utilizando o **Laravel 13**, aproveitando as funcionalidades mais recentes do framework. Abaixo estão os pontos centrais da arquitetura:

- **API First:** O backend foi estruturado seguindo o padrão *API First*, onde todos os endpoints foram desenvolvidos primeiro, permitindo que qualquer cliente (web ou mobile) possa consumir os dados de forma padronizada.
- **Inertia.js & React:** Para o frontend, foi escolhido o **Inertia.js** para construir uma aplicação de página única (SPA) com **React**, mantendo a facilidade de desenvolvimento e o roteamento dentro do ecossistema Laravel.
- **Testes Automatizados:** Foram criados testes unitários e de integração para a API, garantindo a confiabilidade do sistema e facilitando manutenções futuras.
- **Banco de Dados & Seeds:** O banco de dados é gerido inteiramente por **Migrations**. Foram implementadas **Factories** para os modelos de `Service` e `Appointment`, permitindo gerar dados de teste de forma rápida e eficiente.
- **Docker:** Foi escolhida a utilização do **Docker** para garantir um ambiente de desenvolvimento padronizado e isolado, facilitando a execução do projeto em qualquer sistema operacional sem conflitos de dependências.

---

## ⏱️ Tempo de Desenvolvimento

O tempo total investido no desenvolvimento desta solução foi de **5h 30m**.

---

## 🛠️ Como Rodar o Projeto do Zero

Siga os passos abaixo para configurar o ambiente de desenvolvimento em sua máquina local.

### Pré-requisitos

Antes de começar, você precisará ter instalado:
- [Git](https://git-scm.com/)
- [Docker](https://www.docker.com/) e [Docker Compose](https://docs.docker.com/compose/)
- *OU* ambiente local com PHP 8.3+, Composer, Node.js e MySQL.

### Passo 1: Clonar o Repositório

```bash
git clone https://github.com/seu-usuario/agendamentos.git
cd agendamentos
```

### Passo 2: Configuração com Docker (Recomendado)

A maneira mais fácil de rodar o projeto é usando Docker.

1. **Subir os containers:**
   ```bash
   docker-compose up -d
   ```

2. **Instalar dependências e configurar a aplicação:**
   Acesse o container da aplicação para executar os comandos:
   ```bash
   docker exec -it laravel-app bash
   ```
   Dentro do container, execute o script de setup:
   ```bash
   composer run setup
   ```
   *Este comando irá instalar dependências PHP e JS, criar o arquivo .env, gerar a chave da aplicação e rodar as migrações.*

3. **Acessar a aplicação:**
   - Web: [http://localhost:8000](http://localhost:8000)

---

### Passo 2 (Alternativo): Configuração Local

Se preferir rodar sem Docker:

1. **Instalar dependências do PHP:**
   ```bash
   composer install
   ```

2. **Configurar o ambiente:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Edite o arquivo `.env` com suas credenciais de banco de dados local.*

3. **Rodar as migrações e seeders:**
   ```bash
   php artisan migrate
   ```

4. **Instalar dependências do Frontend e Build:**
   ```bash
   npm install
   npm run dev
   ```

5. **Iniciar o servidor:**
   ```bash
   php artisan serve
   ```

---

## 🧪 Como Executar os Testes

Este projeto utiliza o **Pest PHP** para testes automatizados.

### Via Docker:
```bash
docker exec -it laravel-app composer test
```

### Localmente:
```bash
php artisan test
```

---

## 🔌 API Endpoints

A aplicação fornece uma API REST para integração. Todos os endpoints da API (exceto login e registro) requerem autenticação via **Laravel Sanctum**.

### Endpoints Públicos

| Método | Endpoint | Descrição |
| :--- | :--- | :--- |
| `POST` | `/api/register` | Registrar um novo usuário |
| `POST` | `/api/login` | Autenticar usuário e obter token |

### Endpoints Autenticados (Bearer Token)

| Método | Endpoint | Descrição |
| :--- | :--- | :--- |
| `GET` | `/api/user` | Obter dados do usuário logado |
| `POST` | `/api/logout` | Revogar o token de acesso |
| `GET` | `/api/services` | Listar todos os serviços disponíveis |
| `GET` | `/api/appointments` | Listar agendamentos do usuário |
| `POST` | `/api/appointment` | Criar um novo agendamento |

---

## 💻 Funcionalidades da Aplicação

1. **Autenticação:** Sistema completo de login e registro para usuários.
2. **Dashboard:** Visualização de agendamentos realizados.
3. **Agendamento:** Interface para escolher um serviço, data e horário.
4. **Gerenciamento de Serviços:** Listagem de serviços oferecidos pela plataforma.

---

## 📄 Licença

Este projeto é um software de código aberto licenciado sob a [MIT license](https://opensource.org/licenses/MIT).
