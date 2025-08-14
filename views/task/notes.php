<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/loadPatient.js"></script>
    <link rel="stylesheet" href="../public/css/pendingTask.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" integrity="sha512-XcIsjKMcuVe0Ucj/xgIXQnytNwBttJbNjltBV18IOnru2lDPe9KRRyvCXw6Y5H415vbBLRm8+q6fmLUU7DfO6Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Notas</title>
</head>

<h1>Notas para paciente</h1><br>
    <form action="index.php?action=saveNote" method="POST">
        <label for="patient_id">Selecciona un paciente:</label>
        <select name="patient_id" id="patient_id" required>
            <option value="">Selecciona un paciente</option>
            <?php foreach ($patients as $patient): ?>
                <option value="<?php echo $patient['id']; ?>"><?php echo $patient['name']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="note">Notas: </label><br><br>
        <textarea name="note" id="note" rows="4" cols="50" required></textarea><br><br>

        <div>
            <button type="button" onclick="window.location.href='index.php?action=dashboard'">Cancelar</button>
            <button type="submit">Guardar</button>
        </div>
    </form>

</html>

