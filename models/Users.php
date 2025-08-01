
<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $name;
    private $username;
    private $email;
    private $password;
    private $documentType;
    private $documentNumber;
    private $rol;
    public function setname($name) {
        $this->name = $name;
    }

    public function setusername($username) {
        $this->username = $username;
    }

    public function setemail($email) {
        $this->email = $email;
    }

    public function setpassword($password) {
        $this->password = $password;
    }

    public function setdocumentType($documentType) {
        $this->documentType = $documentType;
    }

    public function setDocumentNumber($documentNumber) {
        $this->documentNumber = $documentNumber;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }


 public static function insertUser(User $user) {
    $conn = Database::connect();

    if (self::checkEmailExists($user->email)) {
        return "error: El correo electrónico ya está registrado."; 
    }
    
    $stmt = $conn->prepare("INSERT INTO user (usu_id, name, username, email, password, documentType, documentNumber, rol, created_at, estado) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, NOW(), '1')");

    $stmt->bind_param(
        "sssssss", 
        $user->name, 
        $user->username, 
        $user->email, 
        $user->password, 
        $user->documentType, 
        $user->documentNumber, 
        $user->rol
    );

    if ($stmt->execute()) {
        return "success";
    } else {
        return "error: " . $stmt->error;
    }

}

    public static function checkEmailExists($email) {
    $conn = Database::connect();
    $stmt = $conn->prepare("SELECT usu_id FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    return $stmt->num_rows > 0;  
}


    public static function register($username, $email, $password) {
        $conn = Database::connect();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO user (name, username, email, password, role, created_at) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param($name, $username, $email, $password, $role, $created_at);
        return $stmt->execute();
    }

    public static function login($email, $password) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT usu_id, password FROM user WHERE email = ?");
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
?>