<?php

class Database {
    public static function connect() {
        $host = 'localhost';
        $db = 'gestion_tareas'; 
        $user = 'root';
        $pass = '';

        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        return $conn;
    }
}
