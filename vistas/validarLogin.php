<?php

include_once("../utils/bd.php");

//include_once ("./componentes/foot.php");

$usuario1=$_GET["usuario"];
$clave=$_GET["contraseña"];

$database= new BaseDatos();
$sql="SELECT * FROM usuario WHERE nombre='$usuario1' AND pass='$clave'";

$resultado =$database->selectAll($sql);
var_dump($resultado);
if($resultado){
    session_start();
    $_SESSION["logueado"]=true;

    header("location:index.php");

}else {
    session_start();
    session_destroy();
  header("location:login.php");

exit();

    echo "contraseña incorrecta";

}
