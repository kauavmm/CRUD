<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Helpers\Session;
use App\Helpers\Html;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response;

class UserController {
    private UserModel $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index(ServerRequestInterface $request): ResponseInterface {
        $users = $this->userModel->getAll();
        $usersCount = $this->userModel->count();

        // $users will be the data, and 'users' will be the name of the resulting variable.
        $html = Html::render('user/read', ['users' => $users, 'usersCount' => $usersCount]);
        $response = new Response();
        $response->getBody()->write($html);
        return $response;
    }

    public function create(ServerRequestInterface $request): ResponseInterface {
        $html = Html::render('user/create');
        $response = new Response();
        $response->getBody()->write($html);
        return $response;
    }

    public function store(ServerRequestInterface $request): ResponseInterface {
        // Receive user data from the form create
        $name = trim($_POST["name"] ?? ''); // trim() removes all whitespace, for example " hello " => "hello"
        $surname = trim($_POST["surname"] ?? '');
        $username = trim($_POST["username"] ?? '');
        $phone = trim($_POST["phone"] ?? '');
        $age = $_POST["age"] ?? '';
        $email = trim($_POST["email"] ?? '');
        $password = $_POST["password"] ?? '';

        $errors = [];

        // Name
        if (strlen($name) < 3) {
            $errors['name'] = 'Name must have at least 3 characters.';
        }

        // Surname
        if (strlen($surname) < 3) {
            $errors['surname'] = 'Surname must have at least 3 characters.';
        }

        // Username
        if (strlen($username) < 3) {
            $errors['username'] = 'Username must have at least 3 characters.';
        }

        // Phone
        if (!preg_match('/^\d{9}$/', $phone)) {
            $errors['phone'] = 'Phone must have exactly 9 digits.';
        }

        // Age
        if (!is_numeric($age) || (int) $age < 18) {
            $errors['age'] = 'You must be at least 18 years old.';
        }

        // Email
        // Filter and verify if the email exists
        $emailFilter = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!($emailFilter)) {
            $errors['email'] = 'Please enter a valid e-mail.';
        } else if ($this->userModel->emailExists($emailFilter)) {
            $errors['email'] = 'Email is already in use, please choose another';
        }

        // Password
        if (
            strlen($password) < 8 ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[^A-Za-z0-9]/', $password)
        ) {
            $errors['password'] = 'The password must meet all 5 criteria';
        }

        // Defines the errors
        if (!empty($errors)) {
            Session::set('errors', $errors);
            Session::set('old', [ // Return the validated/correct form inputs
                'name' => $name,
                'surname' => $surname,
                'username' => $username,
                'phone' => $phone,
                'age' => $age,
                'email' => $email
            ]);

            return (new Response())->withStatus(302)->withHeader('Location', '/users/create');
        }

        // Everything validated. Encrypt the password, add the user to the database and redirect to the read page
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->userModel->create($name, $surname, $username, $phone, (int) $age, $emailFilter, $hashedPassword);
        return (new Response())->withStatus(302)->withHeader('Location', '/');
    }

    public function edit(ServerRequestInterface $request, array $args): ResponseInterface {
        $userData = $this->userModel->find($args['id']);
        $html = Html::render('user/update', ['userData' => $userData]);
        $response = new Response();
        $response->getBody()->write($html);
        return $response;
    }

    public function update(ServerRequestInterface $request, array $args): ResponseInterface {
        // Receive user data from the form edit
        $id = $args['id'];
        $name = trim($_POST['name'] ?? '');
        $surname = trim($_POST['surname'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $age = $_POST["age"] ?? '';
        $email = trim($_POST['email'] ?? '');
        $password = $_POST["password"] ?? '';

        $errors = [];

        // Name
        if (strlen($name) < 3) {
            $errors['name'] = 'Name must have at least 3 characters.';
        }

        // Surname
        if (strlen($surname) < 3) {
            $errors['surname'] = 'Surname must have at least 3 characters.';
        }

        // Username
        if (strlen($username) < 3) {
            $errors['username'] = 'Username must have at least 3 characters.';
        }

        // Phone
        if (!preg_match('/^\d{9}$/', $phone)) {
            $errors['phone'] = 'Phone must have exactly 9 digits.';
        }

        // Age
        if (!is_numeric($age) || (int) $age < 18) {
            $errors['age'] = 'You must be at least 18 years old.';
        }

        // Email
        // Filter and verify if the email exists
        $emailFilter = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!($emailFilter)) {
            $errors['email'] = 'Please enter a valid e-mail.';
        } else if ($this->userModel->emailExists($emailFilter, $id)) {
            $errors['email'] = 'Email is already in use, please choose another';
        }

        // Password
        if (!empty($password)) {
            if (
                strlen($password) < 8 ||
                !preg_match('/[A-Z]/', $password) ||
                !preg_match('/[a-z]/', $password) ||
                !preg_match('/[0-9]/', $password) ||
                !preg_match('/[^A-Za-z0-9]/', $password)
            ) {
                $errors['password'] = 'The password must meet all 5 criteria';
            }
        }

        // Defines the errors
        if (!empty($errors)) {
            Session::set('errors', $errors);
            Session::set('old', [ // Return the validated/correct form inputs
                'name' => $name,
                'surname' => $surname,
                'username' => $username,
                'phone' => $phone,
                'age' => $age,
                'email' => $email
            ]);

            return (new Response())->withStatus(302)->withHeader('Location', "/users/$id/edit");
        }
            
        // Everything validated. Edit the user, send data to the database and redirect the user to the read page
        $this->userModel->update($id, $name, $surname, $username, $phone, (int) $age, $emailFilter, $password);
        return (new Response())->withStatus(302)->withHeader('Location', '/');
    }

    public function destroy(ServerRequestInterface $request, array $args): ResponseInterface {
        $this->userModel->delete($args['id']);
        return (new Response())->withStatus(302)->withHeader('Location', '/');
    }
}

?>