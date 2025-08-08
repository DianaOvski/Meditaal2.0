<?php
session_start();
require_once "../models/Patient.php";

$patient = new Patient();

switch ($_GET["op"]) {
    case "guardarPaciente":
        // Recogemos los datos del formulario
        $patient->setNombres($_POST["nombres"]);
        $patient->setApellidos($_POST["apellidos"]);
        $patient->setFechaNacimiento($_POST["fecha_nacimiento"]);
        $patient->setEdad($_POST["edad"]);
        $patient->setGenero($_POST["genero"]);
        $patient->setTipoDocumento($_POST["documento_tipo"]);
        $patient->setNumeroDocumento($_POST["documento_numero"]);
        $patient->setRh($_POST["rh"]);
        $patient->setHijos($_POST["hijos"]);
        $patient->setPais($_POST["pais"]);
        $patient->setCiudad($_POST["ciudad"]);
        $patient->setZona($_POST["zona"]);
        $patient->setDireccion($_POST["direccion"]);
        $patient->setTelefono($_POST["telefono"]);
        $patient->setEmail($_POST["email"]);
        $patient->setOcupacion($_POST["ocupacion"]);
        $patient->setReligion($_POST["religion"]);
        $patient->setEnfermedad($_POST["enfermedad"]);
        $patient->setMedicamento($_POST["medicamento"]);

        // Insertamos el paciente
        $response = Patient::insertPatient($patient);
        echo $response;
        break;

    case "listarPacientes":
        try {
            $patients = Patient::getPatients();
            echo json_encode($patients);  // Devolver los pacientes como JSON
        } catch (Exception $e) {
            // Si hay un error, mostrar el mensaje en formato JSON
            echo json_encode(['error' => $e->getMessage()]);
        }
        break;

    case "eliminarPaciente":
        try {
            $documento = $_POST['documento'];
            $response = Patient::deletePatient($documento);
            echo $response;
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    break;

}

?>
