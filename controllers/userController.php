<?php

class UserController {
    private UserModel $userModel;

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }

    public function index(): void {
        $users = $this->userModel->getAll();
        require_once __DIR__ . '/../views/user/read.php';
    }

    public function create(): void {
        require_once __DIR__ . '/../views/user/create.php';
    }

    public function store(): void {
        // Receive user data from the form
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $username = $_POST["username"];
        $phone = $_POST["phone"];
        $age = (int) $_POST["age"]; // The "$_POST[]" arrives as a string and use "(int)" to convert it into an integer 
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Receive the password via POST method and encrypts it

        // Filter and verify if the email exists
        $emailFilter = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!($emailFilter)) {
            $_SESSION['emailFilter'] = "Invalid email";
            header('Location: index.php?route=create');
            exit();
        } else {
            $emailExists = $this->userModel->emailExists($emailFilter);
            if ($emailExists) {
                $_SESSION['emailExists'] = "Email is already in use, please choose another";
                header('Location: index.php?route=create');
                exit();
            }
            
            // Add user to the database and redirect to read page
            $this->userModel->create($name, $surname, $username, $phone, $age, $email, $password);
            header('Location: index.php?route=index');
            exit();
        }
    }

    public function edit(): void {
        require_once __DIR__ . '/../views/user/update.php';
    }

    public function update($id): void {

    }
}

?>