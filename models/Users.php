
<?php
require_once __DIR__ . '/../config/database.php';

class User {
    public static function register($username, $email, $password) {
        $conn = Database::connect();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO user (name, username, email, password, role, created_at) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param($name, $username, $email, $password, $role, $created_at);
        return $stmt->execute();
    }

    public static function login($email, $password) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT id, password FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hash);
            $stmt->fetch();
            if (password_verify($password, $hash)) {
                return $id;
            }
        }
        return false;
    }
}
