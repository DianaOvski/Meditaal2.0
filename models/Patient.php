<?php
require_once __DIR__ . '/../config/database.php';

class Patient {
    private $nombres;
    private $apellidos;
    private $fecha_nacimiento;
    private $edad;
    private $genero;
    private $tipo_documento;
    private $numero_documento;
    private $rh;
    private $hijos;
    private $pais;
    private $ciudad;
    private $zona;
    private $direccion;
    private $telefono;
    private $email;
    private $ocupacion;
    private $religion;
    private $enfermedad;
    private $medicamento;

    public function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setFechaNacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function setTipoDocumento($tipo_documento) {
        $this->tipo_documento = $tipo_documento;
    }

    public function setNumeroDocumento($numero_documento) {
        $this->numero_documento = $numero_documento;
    }

    public function setRh($rh) {
        $this->rh = $rh;
    }

    public function setHijos($hijos) {
        $this->hijos = $hijos;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    public function setZona($zona) {
        $this->zona = $zona;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setOcupacion($ocupacion) {
        $this->ocupacion = $ocupacion;
    }

    public function setReligion($religion) {
        $this->religion = $religion;
    }
    public function setEnfermedad($enfermedad) {
        $this->enfermedad = $enfermedad;
    }

    public function setMedicamento($medicamento) {
        $this->medicamento = $medicamento;
    }

    public static function insertPatient(Patient $patient) {
        $conn = Database::connect();

        // Validar que el número de documento no exista
        if (self::checkDocumentExists($patient->numero_documento)) {
            return "error: El número de documento ya está registrado.";
        }

        // Inserción de datos
        $stmt = $conn->prepare("INSERT INTO patient (Patient_id, Nombres, Apellidos, Fecha_nacimiento, Edad, Genero, Tipo_identificacion, Documento, RH, Hijos,Pais, Ciudad, Zona, Direccion, Telefono, Email, Ocupacion, Religion, Enfermedad, Medicamento, Created_at, estado) 
        VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), '1')");

     $stmt->bind_param(
            "sssssssssssssssssss",
            $patient->nombres,
            $patient->apellidos,
            $patient->fecha_nacimiento,
            $patient->edad,
            $patient->genero,
            $patient->tipo_documento,
            $patient->numero_documento,
            $patient->rh,
            $patient->hijos,
            $patient->pais,
            $patient->ciudad,
            $patient->zona,
            $patient->direccion,
            $patient->telefono,
            $patient->email,
            $patient->ocupacion,
            $patient->religion,
            $patient->enfermedad,
            $patient->medicamento
        );

        if ($stmt->execute()) {
            return "success";
        } else {
            return "error: " . $stmt->error;
        }
    }

    public static function checkDocumentExists($documento) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT Patient_id FROM patient WHERE Documento = ?");
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }
}

?>