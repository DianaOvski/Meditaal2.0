<?php
require_once __DIR__ . '/../models/Users.php';

class AuthController
{
    public function login()
    {
        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/auth/login.php';
        include __DIR__ . '/../views/layout/footer.php';
    }

    public function createUser()
    {
        $title = "Crear Usuario";
        $view = __DIR__ . '/../views/users/createUser.php';
        include __DIR__ . '/../views/layout/layout.php';
    }

    public function storeUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $user = User::registerDashboard($name, $username, $email, $password, $role);

            if ($user) {
                header("Location: index.php?action=dashboard");
            } else {
                echo "Error al crear el usuario.";
            }
        }
    }

    public function storeLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = User::login($_POST['email'], $_POST['password']);
        if ($userId) {
            $_SESSION['user_id'] = $userId;
            header("Location: index.php?action=dashboard");
        } else {
            echo "Credenciales inválidas.";
        }
    }

    public function dashboard()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $username = $_SESSION['username'] ?? 'Usuario';
        $title = "Dashboard";
        $view = __DIR__ . '/../views/dashboard.php';

        include __DIR__ . '/../views/layout/layout.php';
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
        header("Location: index.php?action=login");
    }
}
