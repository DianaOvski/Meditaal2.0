<?php
require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../models/Patient.php';  // Incluye la clase Patient

session_start();

class TaskController
{

    public function create()
    {
        $title = "Crear tarea";
        $view = __DIR__ . '/../views/task/createTask.php';
        include __DIR__ . '/../views/layout/layout.php';
    }

    public function listTasks()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    require_once __DIR__ . '/../config/database.php';
    $conn = Database::connect();

    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM task WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $tasks = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();

    $view = __DIR__ . '/../views/task/listTask.php';
    $title = 'Mis Tareas';
    $extraCss = 'calendario.css';

    include __DIR__ . '/../views/layout/layout.php';
}


    public function save()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        require_once __DIR__ . '/../config/database.php';

        $conn = Database::connect();

        $user_id = $_SESSION['user_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $due_date = $_POST['due_date'];
        $priority = $_POST['priority'];
        $completed = isset($_POST['completed']) ? 1 : 0;

        $stmt = $conn->prepare("INSERT INTO task (user_id, title, description, due_date, priority, completed) 
                            VALUES (?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            die("Error en la preparación: " . $conn->error);
        }

        $stmt->bind_param("issssi", $user_id, $title, $description, $due_date, $priority, $completed);

        if ($stmt->execute()) {
            header("Location: index.php?action=dashboard");
            exit;
        } else {
            echo "Error al guardar la tarea: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        require_once __DIR__ . '/../config/database.php';
        $conn = Database::connect();

        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("SELECT * FROM task WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $tasks = $result->fetch_all(MYSQLI_ASSOC);

        $view = __DIR__ . '/../views/task/listTask.php';

        $title = 'Mis tareas';
        include __DIR__ . '/../views/layout/layout.php';
    }

  public function deleteTask()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $taskId = $_POST['id'];
        require_once __DIR__ . '/../config/database.php';
        $conn = Database::connect();

        $stmt = $conn->prepare("DELETE FROM task WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $taskId, $_SESSION['user_id']);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }

    // Redirecciona de nuevo a la lista de tareas
    header("Location: index.php?action=listTasks");
    exit;
}

    public function update()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        require_once __DIR__ . '/../config/database.php';
        $conn = Database::connect();

        if (!$conn) {
            die("Error en la conexión a la base de datos.");
        }

        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $due_date = $_POST['due_date'];
        $priority = $_POST['priority'];

        $stmt = $conn->prepare("UPDATE task SET title = ?, description = ?, due_date = ?, priority = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $title, $description, $due_date, $priority, $id);

        if ($stmt->execute()) {
            header("Location: index.php?action=dashboard");
            exit;
        } else {
            echo "Error al actualizar la tarea: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }

public function showPendingTasks()
{
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $userId = $_SESSION['user_id'];

      require_once __DIR__ . '/../config/database.php';
        $conn = Database::connect();

    $stmt = $conn->prepare("SELECT * FROM task WHERE user_id = ? AND completed = 0");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $tasks = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // echo '<pre>'; print_r($tasks); echo '</pre>'; exit;

    $view = __DIR__ . '/../views/task/pendingTask.php';
    $title = 'Tareas Pendientes';
    $extraCss = 'pendingTask.css';

    include __DIR__ . '/../views/layout/layout.php';
}

public function completeTask()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    require_once __DIR__ . '/../config/database.php';

    $conn = Database::connect();

    $id = $_POST['id'];
    $comentario = $_POST['comentario'];
    $archivo = null;

    if (!empty($_FILES['archivo']['name'])) {
        $archivo = basename($_FILES['archivo']['name']);
        move_uploaded_file($_FILES['archivo']['tmp_name'], __DIR__ . '/../public/uploads/' . $archivo);
    }

    $stmt = $conn->prepare("UPDATE task SET comentario = ?, archivo = ?, completed = 1 WHERE id = ?");
    $stmt->bind_param("ssi", $comentario, $archivo, $id);

    if ($stmt->execute()) {
        http_response_code(200);
        echo 'ok';
    } else {
        http_response_code(500);
        echo 'error';
    }

    $stmt->close();
    $conn->close();
}

  public function notes()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        try {
            // Obtén los pacientes desde la base de datos
            $patients = Patient::getPatients();  // Usamos el modelo Patient para obtener la lista

            // Definir la vista a cargar
            $view = __DIR__ . '/../views/task/notes.php';
            $title = 'Notas';
            // Pasar los pacientes a la vista
            include __DIR__ . '/../views/layout/layout.php';  
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();  // Si hay un error, mostrarlo
        }
    }

}