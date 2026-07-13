<?php

class UserController {
    private UserModel $userModel;

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }

    public function index() {
        $users = $this->userModel->getAll();
        require_once __DIR__ . '/../views/user/read.php';
    }
}

?>