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
    case 'register':
        $authController->register();
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


    default:
        echo "Página no encontrada.";
}
