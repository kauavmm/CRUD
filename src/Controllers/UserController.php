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
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $username = $_POST["username"];
        $phone = $_POST["phone"];
        $age = (int) $_POST["age"]; // The "$_POST[]" arrives as a string and use "(int)" to convert it into an integer 
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Filter and verify if the email exists
        $emailFilter = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!($emailFilter)) {
            Session::set('emailFilter', 'Invalid email');
            return (new Response())->withStatus(302)->withHeader('Location', '/users/create');
        } else {
            $emailExists = $this->userModel->emailExists($emailFilter);
            if ($emailExists) {
                Session::set('emailExists', 'Email is already in use, please choose another');
                return (new Response())->withStatus(302)->withHeader('Location', '/users/create');
            }

            // Verify if password input is empty
            if (empty($password)) {
                Session::set('emptyPassword', 'Empty password, please choose one');
                return (new Response())->withStatus(302)->withHeader('Location', '/users/create');
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT); // Encrypts password
            }
            
            // Add the user to the database and redirect to the read page
            $this->userModel->create($name, $surname, $username, $phone, $age, $email, $password);
            return (new Response())->withStatus(302)->withHeader('Location', '/');
        }
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
        $name = $_POST['name'];
        $surname = $_POST["surname"];
        $username = $_POST["username"];
        $phone = $_POST["phone"];
        $age = (int) $_POST["age"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Filter and verify if the email exists
        $emailFilter = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!($emailFilter)) {
            Session::set('emailFilter', 'Invalid email');
            return (new Response())->withStatus(302)->withHeader('Location', "/users/$id/edit");
        } else {
            $emailExists = $this->userModel->emailExists($emailFilter, $id);
            if ($emailExists) {
                Session::set('emailExists', 'Email is already in use, please choose another');
                return (new Response())->withStatus(302)->withHeader('Location', "/users/$id/edit");
            }
            
            // Edit the user, send data to the database and redirect the user to the read page
            $this->userModel->update($id, $name, $surname, $username, $phone, $age, $email, $password);
            return (new Response())->withStatus(302)->withHeader('Location', '/');
        }
    }

    public function destroy(ServerRequestInterface $request, array $args): ResponseInterface {
        $this->userModel->delete($args['id']);
        return (new Response())->withStatus(302)->withHeader('Location', '/');
    }
}

?>