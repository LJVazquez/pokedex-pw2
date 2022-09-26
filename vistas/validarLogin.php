<?php
include_once("../utils/bd.php");

session_start();

$usuario1 = $_GET["usuario"];
$clave = $_GET["contraseña"];

$database = new BaseDatos();
$sql = "SELECT * FROM usuario WHERE nombre='$usuario1' AND pass='$clave'";

$resultado = $database->selectAll($sql);

if (count($resultado) > 0) {
    $_SESSION['messages'] =  ['login_exitoso'];
    $_SESSION["logged"] = true;
    header("Location:index.php");
} else {
    $_SESSION["login_error"] = true;
    header("Location:login.php");
}
