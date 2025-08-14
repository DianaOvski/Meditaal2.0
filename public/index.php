<?php
require_once '../controllers/AuthController.php';
require_once '../controllers/TaskController.php';

$action = $_GET['action'] ?? 'login';

$authController = new AuthController();
$taskController = new TaskController();

switch ($action) {
    case 'login':
        $authController->login();
        break;
    case 'createUser':
    $controller->createUser();
    break;
    case 'storeRegister':
        $authController->storeRegister();
        break;
    case 'storeLogin':
        $authController->storeLogin();
        break;
    case 'dashboard':
        $taskController = new TaskController();
        $taskController->index();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'create':
        $taskController = new TaskController();
        $taskController->create();
        break;
    case 'listTasks':
        $taskController->listTasks();
        break;
    case 'saveTask':
        $taskController = new TaskController();
        $taskController->save();
        break;
    case 'updateTask':
        $taskController->update();
        break;
    case 'deleteTask':
        $taskController->deleteTask();
        break;
    case 'pendingTasks':
        $taskController->showPendingTasks();
        break;
    case 'completeTask':
        $taskController->completeTask();
        break;
    case 'notes':
        $taskController->notes();
        break;

    default:
        echo "Página no encontrada.";
}
