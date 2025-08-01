<?php
session_start();
require_once "../models/Users.php";

$user = new User();

switch ($_GET["op"]) {
    case "guardaryEditar":
        $user->setname($_POST["name"]);
        $user->setusername($_POST["username"]);
        $user->setemail($_POST["email"]);
        $user->setpassword(password_hash($_POST["password"], PASSWORD_DEFAULT));
        $user->setdocumentType($_POST["documentType"]);
        $user->setDocumentNumber($_POST["documentNumber"]);
        $user->setRol($_POST["Rol"]);

        $response = User::insertUser($user);  
        echo $response;  
        break;
}
?>
