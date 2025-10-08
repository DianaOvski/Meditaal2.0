<?php
require_once __DIR__ . '/../config/database.php';

class Agenda {

public static function getAllAppointments() {
    $db = Database::connect();
    $sql = "SELECT 
                a.id, 
                a.paciente_nombre AS title, 
                a.paciente_documento,
                CONCAT(a.fecha_agenda, 'T', a.hora_agendada) AS start,
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

        if (strlen($hora) === 5) {
            $hora .= ":00";
        }

        // 🔹 Asignar color según estado
        switch ($row['estado']) {
            case 'Atendido':
                $color = 'green';
                break;
            case 'Cancelado':
                $color = 'orange';
                break;
            case 'Fallo':
                $color = 'red';
                break;
            default:
                $color = 'lightgray'; // Agendado o cualquier otro
                break;
        }

        $start_iso = $fecha . 'T' . $hora;

        $events[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'start' => $start_iso,
            'color' => $color,  // aqui le coloco un color dinámico
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
        $stmt = $conn->prepare("INSERT INTO agenda (paciente_nombre, paciente_documento, hora_agendada, estado, doctor_id, Nombre_Doctor, fecha_agenda)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return ["success" => false, "message" => "Error al preparar la inserción: " . $conn->error];
        }

        // Asegurar estado por defecto y tipos correctos
        $estado = !empty($estado) ? $estado : 'Agendado';
        $doctor_id = (int)$doctor_id;     

        error_log("✅ Insertando cita: $paciente_documento - Estado: $estado - Doctor: $doctor_id - Fecha: $fecha_agenda");


        // Vincula los parámetros y ejecuta la consulta
        $stmt->bind_param("ssssiss", $paciente_nombre_completo, $paciente_documento, $hora_agendada, $estado, $doctor_id, $doctor_nombre_completo, $fecha_agenda);

        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            // opcional: registrar warnings de MySQL
            if ($res = $conn->query("SHOW WARNINGS")) {
                while ($w = $res->fetch_assoc()) {
                    error_log("MySQL warning: " . $w['Message']);
                }
            }
            return ["success" => false, "message" => "Error al agendar la cita: " . $stmt->error];
        }

        return ["success" => true, "message" => "Cita agendada correctamente."];
    }

     // Método para actualizar la cita
    public static function updateAppointment($event_id, $paciente_nombre, $hora_agendada, $estado, $doctor_id) {
        $conn = Database::connect();

        // 🔹 1. Obtener el nombre completo del doctor
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

        // 🔹 2. Actualizar los datos de la cita (incluyendo Nombre_Doctor y doctor_id)
        $stmt = $conn->prepare("UPDATE agenda 
                                SET paciente_nombre = ?, hora_agendada = ?, estado = ?, doctor_id = ?, Nombre_Doctor = ? 
                                WHERE id = ?");
        $stmt->bind_param("sssisi", $paciente_nombre, $hora_agendada, $estado, $doctor_id, $doctor_nombre_completo, $event_id);

        if ($stmt->execute()) {
            return ["success" => true, "message" => "Cita actualizada correctamente."];
        } else {
            return ["success" => false, "message" => "Error al actualizar la cita: " . $stmt->error];
        }
    }

    // Método para eliminar la cita
    public static function deleteAppointment($event_id) {
        $conn = Database::connect();

        $stmt = $conn->prepare("DELETE FROM agenda WHERE id = ?");
        $stmt->bind_param("i", $event_id);

        if ($stmt->execute()) {
            return ["success" => true, "message" => "Cita eliminada correctamente."];
        } else {
            return ["success" => false, "message" => "Error al eliminar la cita: " . $stmt->error];
        }
    }
}

?>
