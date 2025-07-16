# Todo List API

Application de gestion de tâches avec une API REST PHP et une interface utilisateur en HTML/JS.

## Technologies utilisées

- Backend: PHP
- Frontend: HTML, CSS (Bootstrap), JavaScript
- Base de données: MySQL
- Serveur: Apache (XAMPP)

## Installation

1. Cloner le projet dans le dossier htdocs de XAMPP:
```bash
cd c:/xampp/htdocs
git clone https://github.com/Mouhamed-Kane/api-todo
```

2. Créer la base de données:
```sql
CREATE DATABASE todo_db;
USE todo_db;
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

3. Configurer la base de données dans `/config/database.php`

## Structure du projet

```
api-todo/
├── config/
│   └── database.php
├── tasks/
│   ├── create.php
│   ├── delete.php
│   └── get.php
│   └── get-one.php
│   └── update.php
├── todo-front/
│   ├── index.html
│   ├── script.js
│   └── style.css
└── .htaccess
└── README.md
```

## Endpoints API

- GET `/tasks/get.php` : Récupérer toutes les tâches
- POST `/tasks/create.php` : Créer une nouvelle tâche
- DELETE `/tasks/delete.php` : Supprimer une tâche
- GET `/tasks/get-one.php` : Récupérer une tâche spécifique
- UPDATE `/tasks/update.php` : Mettre à jour une tâche

## Utilisation

1. Démarrer XAMPP (Apache et MySQL)
2. Accéder à l'application: `http://localhost/api-todo/todo-front/`

## Fonctionnalités

- ✅ Affichage des tâches
- ✅ Ajout de tâches
- ✅ Suppression de tâches
- ✅ Interface responsive
