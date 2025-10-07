<?php
// 👇 Mostrar errores durante desarrollo (¡quitar en producción!)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 👇 Asegurar que la respuesta sea JSON
header('Content-Type: application/json');

// Incluir modelo Agenda
require_once "../models/Agenda.php";

// Manejar solicitud GET: obtener todas las citas
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $events = Agenda::getAllAppointments();
        echo json_encode($events);
    } catch (Exception $e) {
        http_response_code(500); // Error del servidor
        echo json_encode(["error" => "Error al obtener citas: " . $e->getMessage()]);
    }
    exit;
}

// Manejar solicitud POST: crear, actualizar o eliminar citas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents("php://input"), true);

    if (!$inputData) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Datos no válidos"]);
        exit;
    }

    // Crear nueva cita
if (isset($inputData['action']) && $inputData['action'] === 'create') {
    if (!isset($inputData['paciente_documento'], $inputData['hora'], $inputData['doctor'], $inputData['estado'], $inputData['fecha_agenda'])) {
        http_response_code(400);
        echo json_encode(["error" => "Faltan datos para crear la cita"]);
        exit;
    }

    $paciente_documento = $inputData['paciente_documento'];
    $hora_agendada = $inputData['hora'];
    $doctor_id = $inputData['doctor'];
    $estado = !empty($inputData['estado']) ? $inputData['estado'] : 'Agendado';
    $fecha_agenda = $inputData['fecha_agenda'];

    try {
        $response = Agenda::agendarCita($paciente_documento, $hora_agendada, $doctor_id, $estado, $fecha_agenda);
        echo json_encode($response);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error al agendar cita: " . $e->getMessage()]);
    }
    exit;
}

    // Actualizar cita existente
    if (isset($inputData['action'], $inputData['event_id']) && $inputData['action'] === 'update') {
        if (!isset($inputData['paciente_nombre'], $inputData['hora'], $inputData['estado'])) {
            http_response_code(400);
            echo json_encode(["error" => "Faltan datos para actualizar la cita"]);
            exit;
        }

        $event_id = $inputData['event_id'];
        $paciente_nombre = $inputData['paciente_nombre'];
        $hora_agendada = $inputData['hora'];
        $estado = $inputData['estado'];

        try {
            $response = Agenda::updateAppointment($event_id, $paciente_nombre, $hora_agendada, $estado);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => "Error al actualizar cita: " . $e->getMessage()]);
        }
        exit;
    }

    // Eliminar cita
    if (isset($inputData['action'], $inputData['event_id']) && $inputData['action'] === 'delete') {
        $event_id = $inputData['event_id'];

        try {
            $response = Agenda::deleteAppointment($event_id);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => "Error al eliminar cita: " . $e->getMessage()]);
        }
        exit;
    }

    // Si ninguna condición se cumple
    http_response_code(400);
    echo json_encode(["error" => "Solicitud POST no válida"]);
}
?>
