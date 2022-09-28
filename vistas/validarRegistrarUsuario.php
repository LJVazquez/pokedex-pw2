<?php

include_once("../utils/bd.php");

//include_once ("./componentes/foot.php");

$usuario1=$_GET["usuario"];
$clave=$_GET["contraseña"];
$claveRepetida=$_GET["repitecontraseña"];

$database= new BaseDatos();
$pokeDb = new PokeBd();

$sql1="SELECT * FROM usuario WHERE nombre='$usuario1' AND pass='$clave'";
$sql2="INSERT INTO usuario (nombre, pass) VALUES ('?', '?')";

if($clave == $claveRepetida){

    $resultado =$database->selectAll($sql1);
    var_dump($resultado);

    if(!$resultado){
        $createdId = $pokeDb->createUser($usuario1, $clave);
        //$pokeDb->insertPreparedStatement($sql2,"ss",[$usuario1,$clave]);

        session_start();
        $_SESSION["logueado"]=true;

        header("location:index.php");

    }else {
        session_start();
        session_destroy();
        header("location:registrarUsuario.php");
        exit();

        echo "El usuario ya se encontraba registrado";

    }

    header("location:index.php");
    echo "Repita su contraseña";
}

header("location:registrarUsuario.php");
