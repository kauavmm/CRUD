# CRUD - User Management

A user management CRUD application built in PHP from scratch, following the MVC pattern. This project started as a simple practice exercise and evolved into a more structured application, incorporating professional practices such as PSR-4 autoloading, dependency injection, routing, and PSR-7 requests/responses.

## Technologies

- PHP 8.3
- MySQL 8
- PDO (prepared statements)
- Composer
- League Route (routing)
- Laminas Diactoros (PSR-7 implementation)
- Apache (mod_rewrite)
- Docker / Docker Compose
- Bootstrap 5
- phpMyAdmin

## Features

- Full CRUD (Create, Read, Update, Delete) for users
- MVC architecture with clear separation between Models, Controllers and Views
- Database connection handled through a Singleton pattern
- Protection against SQL Injection via prepared statements
- Password hashing with `password_hash()`
- Email validation, including duplicate email checks (excluding the user's own record when editing)
- Flash messages through a custom Session helper class
- Custom Html helper class using output buffering (`ob_start()` / `ob_get_clean()`) to render views
- Clean URLs (`/users`, `/users/{id}/edit`, etc.) powered by League Route and PSR-7
- PSR-4 autoloading via Composer, replacing manual `require_once` statements

## The Process

This project began as a very simple CRUD using `mysqli` and raw SQL queries concatenated directly into strings, with no real protection against SQL Injection and no separation of concerns.

It was rebuilt from scratch using PDO with prepared statements and the MVC pattern, splitting the code into Models, Controllers and Views. From there, it kept evolving step by step:

- A `Database` class was introduced as a Singleton to manage the PDO connection.
- A `Session` helper class replaced direct `$_SESSION` manipulation, adding a `flash()` method to read and clear messages in one step.
- An `Html` helper class was created to render views using output buffering, removing scattered `require_once` calls from the controllers.
- The project was migrated to use Composer with PSR-4 autoloading, removing the need for manual `require_once` statements across the codebase.
- Routing was migrated from a manual `match($route)` block reading `$_GET['route']` to League Route, using PSR-7 requests and responses (via Laminas Diactoros) and clean URLs enabled through Apache's `mod_rewrite`.

Each step was implemented and tested individually to make sure the application kept working end to end throughout the refactor.

## Running the Project

1. Clone the repository
2. Install PHP dependencies: `composer install`
3. Start the containers: `docker compose up --build`
4. Open `http://localhost:8082` in your browser
5. Access phpMyAdmin (if needed) at `http://localhost:8080`
