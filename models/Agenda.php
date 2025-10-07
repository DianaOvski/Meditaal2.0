<?php
require_once __DIR__ . '/../config/database.php';

class Agenda {

public static function getAllAppointments() {
    $db = Database::connect();
    $sql = "SELECT 
                a.id, 
                a.paciente_nombre AS title, 
                a.paciente_documento,
                -- DATE(a.fecha_agenda) AS fecha,  -- ✅ Extrae solo la parte de la fecha
                CONCAT(a.fecha_agenda, 'T', a.hora_agendada) AS start,
                'lightblue' AS color, 
                a.estado, 
                a.doctor_id,
                a.fecha_agenda,
                a.hora_agendada,
                CONCAT(u.name, ' ', u.username) AS doctor
            FROM agenda a
            JOIN user u ON a.doctor_id = u.usu_id
            WHERE u.rol = 'Doctor'";

    $query = $db->query($sql);
    $events = [];

while ($row = $query->fetch_assoc()) {
    $fecha = $row['fecha_agenda'];
    $hora = $row['hora_agendada'];

    // Asegura de que la hora tenga formato HH:MM:SS
    if (strlen($hora) === 5) {
        $hora .= ":00";
    }

    $start_iso = $fecha . 'T' . $hora;

    $events[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'start' => $start_iso,
        'color' => 'lightblue',
        'estado' => $row['estado'],
        'doctor_id' => $row['doctor_id'],
        'doctor' => $row['doctor'],
        'paciente_documento' => $row['paciente_documento'] 
    ];
}

    return $events;
}

    // Método para agendar la cita
    public static function agendarCita($paciente_documento, $hora_agendada, $doctor_id, $estado, $fecha_agenda) {
        $conn = Database::connect();

        // Obtener el nombre del paciente (si solo estás guardando el documento)
        $stmt_patient = $conn->prepare("SELECT Nombres, Apellidos FROM patient WHERE Documento = ?");
        error_log("Debug estado: '$estado'");
        $stmt_patient->bind_param("s", $paciente_documento);
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
        $stmt = $conn->prepare("INSERT INTO Agenda (paciente_nombre, paciente_documento, hora_agendada, estado, doctor_id, Nombre_Doctor, fecha_agenda)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Vincula los parámetros y ejecuta la consulta
        $stmt->bind_param("sssisss", $paciente_nombre_completo, $paciente_documento, $hora_agendada, $estado, $doctor_id, $doctor_nombre_completo, $fecha_agenda);

        if ($stmt->execute()) {
            // Si se insertó correctamente, devuelve un mensaje de éxito
            return ["success" => true, "message" => "Cita agendada correctamente."];
        } else {
            // Si hay un error, devuelve un mensaje de error
            return ["success" => false, "message" => "Error al agendar la cita: " . $stmt->error];
        }
    }

     // Método para actualizar la cita
    public static function updateAppointment($event_id, $paciente_nombre, $hora_agendada, $estado) {
        $conn = Database::connect();

        $stmt = $conn->prepare("UPDATE Agenda SET paciente_nombre = ?, hora_agendada = ?, estado = ? WHERE id = ?");
        $stmt->bind_param("sssi", $paciente_nombre, $hora_agendada, $estado, $event_id);

        if ($stmt->execute()) {
            return ["success" => true, "message" => "Cita actualizada correctamente."];
        } else {
            return ["success" => false, "message" => "Error al actualizar la cita: " . $stmt->error];
        }
    }

    // Método para eliminar la cita
    public static function deleteAppointment($event_id) {
        $conn = Database::connect();

        $stmt = $conn->prepare("DELETE FROM Agenda WHERE id = ?");
        $stmt->bind_param("i", $event_id);

        if ($stmt->execute()) {
            return ["success" => true, "message" => "Cita eliminada correctamente."];
        } else {
            return ["success" => false, "message" => "Error al eliminar la cita: " . $stmt->error];
        }
    }
}

?>
