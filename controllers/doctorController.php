<?php
require_once "../models/Doctor.php";

switch ($_GET["op"]) {
    case "listarDoctores":
        $doctors = Doctor::getAllDoctors();
        $doctorList = [];

        foreach ($doctors as $doctor) {
            $doctorList[] = [
                'id' => $doctor->getId(),  // Usamos el getter 'getId()'
                'name' => $doctor->getName(), // Usamos el getter 'getName()'
                'lastName' => $doctor->getLastName() // Usamos el getter 'getLastName()'
            ];
        }
        echo json_encode($doctorList);
        break;
}
?>
