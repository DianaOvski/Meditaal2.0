<?php
require_once __DIR__ . '/../config/database.php';

class Agenda {

public static function getAllAppointments() {
    $conn = Database::connect();

    // Obtener todas las citas
    $query = "SELECT paciente_nombre, hora_agendada, estado, Nombre_Doctor, fecha_agenda 
              FROM Agenda";  // Consulta todas las citas

    $result = $conn->query($query);

    $events = [];
    
    // Recorre todas las filas de la base de datos y las convierte en eventos para el calendario
    while ($row = $result->fetch_assoc()) {
        $events[] = [
            'title' => $row['paciente_nombre'],  // Nombre del paciente
            'start' => $row['fecha_agenda'],     // Fecha y hora del evento (la columna `fecha_agenda` debe incluir la hora)
            'color' => $row['estado'] == 'Agendado' ? 'lightblue' : 'gray',  // Color basado en el estado
            'doctor' => $row['Nombre_Doctor'],  // Nombre del doctor
        ];
    }

    return $events;
}

    // Método para agendar la cita
    public static function agendarCita($paciente_nombre, $hora_agendada, $doctor_id, $estado) {
        $conn = Database::connect();

        // Obtener el nombre del paciente (si solo estás guardando el documento)
        $stmt_patient = $conn->prepare("SELECT Nombres, Apellidos FROM patient WHERE Documento = ?");
        $stmt_patient->bind_param("s", $paciente_nombre);
        $stmt_patient->execute();
        $stmt_patient->store_result();

        if ($stmt_patient->num_rows > 0) {
            $stmt_patient->bind_result($nombres, $apellidos);
            $stmt_patient->fetch();
            $paciente_nombre_completo = $nombres . ' ' . $apellidos;
        } else {
            return ["success" => false, "message" => "Paciente no encontrado"];
        }

        // Obtener el nombre del doctor
        $stmt_doctor = $conn->prepare("SELECT name, username FROM user WHERE usu_id = ? AND rol = 'Doctor'");
        $stmt_doctor->bind_param("i", $doctor_id);
        $stmt_doctor->execute();
        $stmt_doctor->store_result();

        if ($stmt_doctor->num_rows > 0) {
            $stmt_doctor->bind_result($doctor_name, $doctor_username);
            $stmt_doctor->fetch();
            $doctor_nombre_completo = $doctor_name . ' ' . $doctor_username;
        } else {
            return ["success" => false, "message" => "Doctor no encontrado"];
        }

        // Prepara la consulta SQL para insertar la cita
        $stmt = $conn->prepare("INSERT INTO Agenda (paciente_nombre, hora_agendada, estado, doctor_id, Nombre_Doctor)
                                VALUES (?, ?, ?, ?, ?)");

        // Vincula los parámetros y ejecuta la consulta
        $stmt->bind_param("sssis", $paciente_nombre_completo, $hora_agendada, $estado, $doctor_id, $doctor_nombre_completo);

        if ($stmt->execute()) {
            // Si se insertó correctamente, devuelve un mensaje de éxito
            return ["success" => true, "message" => "Cita agendada correctamente."];
        } else {
            // Si hay un error, devuelve un mensaje de error
            return ["success" => false, "message" => "Error al agendar la cita: " . $stmt->error];
        }
    }
}

?>
