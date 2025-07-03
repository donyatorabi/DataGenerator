# 🧰 Laravel Task Manager with RabbitMQ

This is a Dockerized Laravel application for managing tasks. Each task event (create/toggle) is published to RabbitMQ for consumption by other services (e.g. a Symfony consumer).

---

## ✨ Features

- Create & toggle user tasks
- Events are published to RabbitMQ for auditing
- MySQL as primary DB
- Fully containerized with Docker
- Makefile for easy command access

---

## ⚡ Quick Start

### 1. Clone the Project

```bash
git clone https://github.com/donyatorabi/DataGenerator.git
cd laravel
```

### 2. Create `.env`

```bash
cp .env.example .env
php artisan key:generate
```

Update environment variables if needed (DB, RabbitMQ, etc).

---

## 🐳 Docker Setup

### Start services

```bash
make up
```

### Install dependencies

```bash
make install
```

### Run migrations

```bash
make migrate
```

---

## 🔗 Access URLs

| Service    | URL                      |
|------------|--------------------------|
| Laravel    | http://localhost:8000    |
| RabbitMQ   | http://localhost:15673   |
| MySQL      | localhost:3306 (Docker)  |

---

## 🔧 Make Commands

| Command        | Description                     |
|----------------|---------------------------------|
| `make up`      | Start Docker containers         |
| `make down`    | Stop and remove containers      |
| `make install` | Install Composer and NPM deps   |
| `make migrate` | Run Laravel DB migrations       |
| `make bash`    | Shell access to container       |
| `make test`    | Run Laravel feature/unit tests  |

---

## 👨‍💻 Author

Donya Torabi
---
