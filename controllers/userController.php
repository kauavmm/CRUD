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

            // Verify if password input is empty
            if (empty($password)) {
                $_SESSION['emptyPassword'] = "Empty password, please choose one";
                header('Location: index.php?route=create');
                exit();
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT); // Encrypts password
            }
            
            // Add the user to the database and redirect to the read page
            $this->userModel->create($name, $surname, $username, $phone, $age, $email, $password);
            header('Location: index.php?route=index');
            exit();
        }
    }

    public function edit(string $id): void {
        $userData = $this->userModel->find($id);
        require_once __DIR__ . '/../views/user/update.php';
    }

    public function update(string $id): void {
        // Receive user data from the form edit
        $id;
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
            $_SESSION['emailFilter'] = "Invalid email";
            header("Location: index.php?route=edit&id=$id");
            exit();
        } else {
            $emailExists = $this->userModel->emailExists($emailFilter, $id);
            if ($emailExists) {
                $_SESSION['emailExists'] = "Email is already in use, please choose another";
                header("Location: index.php?route=edit&id=$id");
                exit();
            }
            
            // Edit the user, send data to the database and redirect the user to the read page
            $this->userModel->update($id, $name, $surname, $username, $phone, $age, $email, $password);
            header('Location: index.php?route=index');
            exit();
        }
    }

    public function destroy(string $id): void {
        
    }
}

?>