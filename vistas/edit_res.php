<?php include_once("./componentes/header.php");
include_once("../utils/bd.php");
$pokeDb = new PokeBd();
$id = $_POST['id'];

if (!isset($_POST['submit'])) {
    header('Location: create.php');
}

//validacion
$errors = [];

foreach ($_POST as $key => $data) {
    if (strlen($data) === 0) {
        array_push($errors, $key);
    }
}

if (strlen($_FILES['imagen']['name']) > 0 && !str_contains($_FILES['imagen']['type'], 'image')) {
    array_push($errors, 'imagen');
}

//error 0 es ok, error 4 es que no se subió archivo
if ($_FILES['imagen']['error'] != 0 && $_FILES['imagen']['error'] != 4) {
    array_push($errors, 'carga');
}

if (count($errors) != 0) {
    session_start();
    $_SESSION['errors'] = $errors;
    $_SESSION['data'] = $_POST;
    header("Location: edit.php?id=$id");
    die();
}

// fin validacion

$nombre = $_POST['nombre'];
$numero = (int)$_POST['numero'];
$descripcion = $_POST['descripcion'];
$tipo1 = (int)$_POST['tipo_1'];
$tipo2 = $_POST['tipo_2'] === '0' ? null : (int)$_POST['tipo_2'];
$imagen = $_FILES['imagen'];

$nombreImagen = '';

if (strlen($_FILES['imagen']['name']) === 0) {
    $nombreImagen = $_POST['ruta_imagen_actual'];
} else {
    $imagenExpl = explode('.', $imagen['name']);
    $imagenExt = end($imagenExpl);
    $nombreImagen = uniqid() . ".$imagenExt";
    move_uploaded_file($imagen['tmp_name'], "../img/pokemons/$nombreImagen");
};

session_start();

$isUpdateSuccessful = $pokeDb->updatePokemon($id, $numero, $nombre, $descripcion, $nombreImagen, $tipo1, $tipo2);

if ($isUpdateSuccessful) {
    $_SESSION['messages'] =  ['actualizado'];
} else {
    $_SESSION['messages'] =  ['no_actualizado'];
}


header("Location: edit.php?id=$id");
die();
