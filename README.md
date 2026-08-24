# MVC User CRUD

A user management CRUD application built in PHP from scratch, following the MVC pattern. This project started as a simple practice exercise and evolved into a more structured application, incorporating professional practices such as PSR-4 autoloading, dependency injection, routing, and PSR-7 requests/responses.

## Technologies

- PHP 8.3
- MySQL 8
- PDO (prepared statements)
- Composer
- League Route (routing)
- League Container (dependency injection)
- League Plates (template engine)
- Laminas Diactoros (PSR-7 implementation)
- Apache (mod_rewrite)
- Docker / Docker Compose
- Bootstrap 5 (+ Bootstrap Icons)
- phpMyAdmin

## Features

- Full CRUD (Create, Read, Update, Delete) for users
- MVC architecture with clear separation between Models, Controllers and Views
- Dependency Injection via League Container, with `UserModel` and `UserController` receiving their dependencies through the constructor instead of instantiating them internally
- Protection against SQL Injection via prepared statements
- Password hashing with `password_hash()`
- Email validation, including duplicate email checks (excluding the user's own record when editing)
- Client-side validation with real-time feedback (Bootstrap is-valid/is-invalid states), including a live password strength meter with a visual criteria checklist
- Server-side validation mirroring all client-side rules, since client-side checks can be bypassed
- Optional password field on user edit — leaving it blank keeps the current password unchanged
- Custom design system on top of Bootstrap, using CSS custom properties for colors, spacing and typography (Inter font)
- Delete confirmation via Bootstrap modal, dynamically populated per row
- Flash messages through a custom Session helper class
- View rendering powered by League Plates wrapped in a static `Html` helper class with layout inheritance and sections
- Clean URLs (`/users`, `/users/{id}/edit`, etc.) powered by League Route and PSR-7
- PSR-4 autoloading via Composer, replacing manual `require_once` statements

## The Process

This project began as a very simple CRUD using `mysqli` and raw SQL queries concatenated directly into strings, with no real protection against SQL Injection and no separation of concerns.

It was rebuilt from scratch using PDO with prepared statements and the MVC pattern, splitting the code into Models, Controllers and Views. From there, it kept evolving step by step:

- A `Database` class was introduced as a Singleton to manage the PDO connection.
- A `Session` helper class replaced direct `$_SESSION` manipulation, adding a `flash()` method to read and clear messages in one step.
- An initial `Html` helper class was created using PHP's output buffering `ob_start() / ob_get_clean()` to render views, removing scattered `require_once` calls from the controllers.
- The project was migrated to use Composer with PSR-4 autoloading, removing the need for manual `require_once` statements across the codebase.
- Routing was migrated from a manual `match($route)` block reading `$_GET['route']` to League Route, using PSR-7 requests and responses (via Laminas Diactoros) and clean URLs enabled through Apache's `mod_rewrite`.
- The custom rendering system was upgraded by integrating League Plates `league/plates`, wrapping its `Engine` instance inside the `Html` helper class to enable native template inheritance, layouts, and sections.
- The `Database` Singleton class was later replaced by a proper Dependency Injection container using `league/container`. A `container.php` file now centralizes the PDO connection setup (registered as a shared instance, so it's created only once), and both `UserModel` and `UserController` were refactored to receive their dependencies through the constructor instead of instantiating or fetching them internally. This removed the coupling to the static `Database::getConnection()` call and made the classes easier to reason about and, potentially, to test in isolation.

The forms gained a full validation layer built in two parts: instant feedback on the client side (matching Bootstrap's validation states) and equivalent rules re-checked on the server, since client-side validation alone can always be bypassed. This included handling edge cases like floating-point rounding errors in JavaScript percentage calculations, and reconciling a custom validation system with Bootstrap's native HTML5 validation styling (:valid/:invalid pseudo-classes), which were initially conflicting.

Each step was implemented and tested individually to make sure the application kept working end to end throughout the refactor.

## Running the Project

1. Clone the repository
2. Install PHP dependencies: `composer install`
3. Start the containers: `docker compose up --build`
4. Open `http://localhost:8082` in your browser
5. Access phpMyAdmin (if needed) at `http://localhost:8080`
