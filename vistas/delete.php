<?php
include_once("../utils/bd.php");
$pokeDb = new PokeBd();

if (!isset($_POST['submit'])) {
    header("Location: index.php");
}

$id = $_POST['id'];

session_start();
$isDeleteSuccessful = $pokeDb->deletePokemon($id);

if ($isDeleteSuccessful) {
    $_SESSION['messages'] =  ['borrado_exitoso'];
    header("Location: index.php");
} else {
    $_SESSION['errors'] =  ['borrar_error'];
    header("Location: detail.php?id=$id");
}

die();
