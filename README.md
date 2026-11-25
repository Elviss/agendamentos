🇧🇷 [Leia em português](README.pt-BR.md)

# Appointment Scheduling System

![Tests](https://github.com/Elviss/agendamentos/actions/workflows/laravel.yml/badge.svg)

This is an appointment scheduling system built with **Laravel 13**, **Inertia.js**, and **React**. The application lets users sign up, log in, view the available services, and book appointments through both the web interface and a REST API.

## 🚀 Technologies Used

- **Backend:** Laravel 13
- **Frontend:** React (via Inertia.js)
- **Styling:** Tailwind CSS
- **Database:** MySQL
- **Testing:** Pest PHP
- **Containerization:** Docker & Docker Compose

---

## 🧠 Technical Decisions

This project was built with **Laravel 13**, taking advantage of the framework's latest features. The key architectural points are:

- **API First:** The backend follows the *API First* approach: all endpoints were developed first, so any client (web or mobile) can consume the data in a standardized way.
- **Inertia.js & React:** **Inertia.js** was chosen for the frontend to build a single-page application (SPA) with **React**, keeping development simple and routing within the Laravel ecosystem.
- **Automated Testing:** Unit and integration tests were written for the API, ensuring the system's reliability and making future maintenance easier.
- **Database & Seeds:** The database is managed entirely through **Migrations**. **Factories** were implemented for the `Service` and `Appointment` models, making it quick and easy to generate test data.
- **Docker:** **Docker** was chosen to provide a standardized, isolated development environment, so the project runs on any operating system without dependency conflicts.

---

## ⏱️ Development Time

The total time invested in developing this solution was **5h 30m**.

---

## 🛠️ Getting Started from Scratch

Follow the steps below to set up the development environment on your local machine.

### Prerequisites

Before you begin, make sure you have installed:

- [Git](https://git-scm.com/)
- [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/)
- *OR* a local environment with PHP 8.3+, Composer, Node.js, and MySQL.

### Step 1: Clone the Repository

```bash
git clone https://github.com/Elviss/agendamentos.git
cd agendamentos
```

### Step 2: Docker Setup (Recommended)

The easiest way to run the project is with Docker.

1. **Start the containers:**

   ```bash
   docker-compose up -d
   ```

2. **Install dependencies and configure the application:** Access the application container to run the commands:

   ```bash
   docker exec -it laravel-app bash
   ```

   Inside the container, run the setup script:

   ```bash
   composer run setup
   ```

   *This command installs the PHP and JS dependencies, creates the .env file, generates the application key, and runs the migrations.*

3. **Open the application:**

   - Web: [http://localhost:8000](http://localhost:8000)

---

### Step 2 (Alternative): Local Setup

If you prefer to run it without Docker:

1. **Install the PHP dependencies:**

   ```bash
   composer install
   ```

2. **Configure the environment:**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   *Edit the `.env` file with your local database credentials.*

3. **Run the migrations and seeders:**

   ```bash
   php artisan migrate
   ```

4. **Install the frontend dependencies and build:**

   ```bash
   npm install
   npm run dev
   ```

5. **Start the server:**

   ```bash
   php artisan serve
   ```

---

## 🧪 Running the Tests

This project uses **Pest PHP** for automated testing.

### With Docker:

```bash
docker exec -it laravel-app composer test
```

### Locally:

```bash
php artisan test
```

---

## 🔌 API Endpoints

The application provides a REST API for integration. All API endpoints (except login and registration) require authentication via **Laravel Sanctum**.

### Public Endpoints

| Method | Endpoint        | Description                          |
| ------ | --------------- | ------------------------------------ |
| `POST` | `/api/register` | Register a new user                  |
| `POST` | `/api/login`    | Authenticate a user and get a token  |

### Authenticated Endpoints (Bearer Token)

| Method | Endpoint            | Description                          |
| ------ | ------------------- | ------------------------------------ |
| `GET`  | `/api/user`         | Get the logged-in user's data        |
| `POST` | `/api/logout`       | Revoke the access token              |
| `GET`  | `/api/services`     | List all available services          |
| `GET`  | `/api/appointments` | List the user's appointments         |
| `POST` | `/api/appointment`  | Create a new appointment             |

---

## 💻 Application Features

1. **Authentication:** Login and registration for users.
2. **Dashboard:** View booked appointments.
3. **Scheduling:** Interface to choose a service, date, and time.
4. **Service Management:** List of the services offered by the platform.

---

## 📄 License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
