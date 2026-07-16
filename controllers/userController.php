<?php

class UserController {
    private UserModel $userModel;

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }

    public function index(): void {
        $users = $this->userModel->getAll();
        // $users will be the data, and 'users' will be the name of the resulting variable.
        echo Html::render('/../views/user/read.php', ['users' => $users]);
    }

    public function create(): void {
        echo Html::render('/../views/user/create.php');
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
            Session::set('emailFilter', 'Invalid email');
            header('Location: index.php?route=create');
            exit();
        } else {
            $emailExists = $this->userModel->emailExists($emailFilter);
            if ($emailExists) {
                Session::set('emailExists', 'Email is already in use, please choose another');
                header('Location: index.php?route=create');
                exit();
            }

            // Verify if password input is empty
            if (empty($password)) {
                Session::set('emptyPassword', 'Empty password, please choose one');
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
        echo Html::render('/../views/user/update.php', ['userData' => $userData]);
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
            Session::set('emailFilter', 'Invalid email');
            header("Location: index.php?route=edit&id=$id");
            exit();
        } else {
            $emailExists = $this->userModel->emailExists($emailFilter, $id);
            if ($emailExists) {
                Session::set('emailExists', 'Email is already in use, please choose another');
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
        $this->userModel->delete($id);
        header('Location: index.php?route=index');
        exit();
    }
}

?>