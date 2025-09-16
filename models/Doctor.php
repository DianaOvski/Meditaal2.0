<?php
require_once __DIR__ . '/../config/database.php';

class Doctor {
    private $id;
    private $name;
    private $lastName;

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastName() {
        return $this->lastName;
    }

    // Método para obtener todos los doctores
    public static function getAllDoctors() {
        $conn = Database::connect();
        $query = "SELECT usu_id AS id, name, username FROM user WHERE rol = 'Doctor' AND estado = 1"; 
        $result = $conn->query($query);

        $doctors = [];
        while ($row = $result->fetch_assoc()) {
            $doctor = new Doctor();
            $doctor->setId($row['id']); // Usamos 'id' que es el alias
            $doctor->setName($row['name']);
            $doctor->setLastName($row['username']); // Usamos 'username' como el apellido
            $doctors[] = $doctor;
        }

        return $doctors;
    }
}
?>
