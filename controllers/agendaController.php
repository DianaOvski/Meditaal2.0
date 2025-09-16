<?php
require_once "../models/Agenda.php"; // Asegúrate de que el modelo Agenda esté incluido

// agendaController.php

// Verifica si la solicitud es GET para obtener las citas
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Obtener todas las citas agendadas
    $events = Agenda::getAllAppointments();

    // Retorna los eventos como JSON
    echo json_encode($events);
}


// Verifica si la solicitud es POST para guardar la cita
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Leer los datos del cuerpo de la solicitud (JSON)
    $inputData = json_decode(file_get_contents("php://input"), true);

    // Verifica si los datos fueron enviados
    if (isset($inputData['paciente_nombre'], $inputData['hora'], $inputData['doctor'], $inputData['estado'])) {
        $paciente_nombre = $inputData['paciente_nombre'];
        $hora_agendada = $inputData['hora'];
        $doctor_id = $inputData['doctor'];
        $estado = $inputData['estado'];

        // Inserta los datos en la base de datos
        $response = Agenda::agendarCita($paciente_nombre, $hora_agendada, $doctor_id, $estado);

        // Retorna la respuesta
        echo json_encode($response);
    } else {
        // Si faltan datos, devuelve un error
        echo json_encode(["success" => false, "message" => "Datos incompletos"]);
    }
}
?>
