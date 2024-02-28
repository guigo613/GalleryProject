<?php

require_once 'app/models/user.php';

class LoginController {
    public function index() {
        include 'app/views/login.php';
    }

    public function manager() {
        
    }

    public function new() {
        
    }

    public function authenticate() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $users = new Users();
        $user = $users->authenticate($username, $password);

        if ($user) {
            $_SESSION["user"] = serialize($user);
            header('Location: /?route=gallery');
            exit();
        } else {
            $error_message = "Usuário ou senha inválidos.";
            include 'app/views/login.php';
        }
    }

    public function add() {
        
    }

    public function remove() {
        
    }

    public function logout() {
        session_destroy();
        header('Location: /?route=login');
    }
}