<?php include_once("./componentes/header.php");
include_once("../utils/bd.php");
$pokeDb = new PokeBd();

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

if (strlen($_FILES['imagen']['name']) === 0 || !str_contains($_FILES['imagen']['type'], 'image')) {
    array_push($errors, 'imagen');
} else if ($_FILES['imagen']['error'] != 0) {
    array_push($errors, 'carga');
}

if (count($errors) > 0) {
    session_start();
    $_SESSION['errors'] = $errors;
    $_SESSION['data'] = $_POST;
    header('Location: create.php');
    die();
}

// fin validacion

$nombre = $_POST['nombre'];
$numero = (int)$_POST['numero'];
$descripcion = $_POST['descripcion'];
$tipo1 = (int)$_POST['tipo_1'];
$tipo2 = $_POST['tipo_2'] === '0' ? null : (int)$_POST['tipo_2'];
$imagen = $_FILES['imagen'];

$imagenExpl = explode('.', $imagen['name']);
$imagenExt = end($imagenExpl);
$nombreImagen = uniqid() . ".$imagenExt";

move_uploaded_file($imagen['tmp_name'], "../img/pokemons/$nombreImagen");

$createdPoke = $pokeDb->createPokemon($numero, $nombre, $descripcion, $nombreImagen, $tipo1, $tipo2);

?>

<div class="container">
    <div class="row">
        <div class="col text-center">
            <?php if (isset($_POST['submit']) && isset($createdPoke)) { ?>
                <h2>¡Pokemon creado!</h2>
                <img src="../img/happy-toge.png" alt="togepi feliz" height="250">

                <div class="col-6 col-lg-4 col-xl-3 m-auto text-start">
                    <a href="./detail.php?id=<?= $createdPoke['id'] ?>" class="text-decoration-none">
                        <div class="poke-card d-flex align-items-center justify-content-between p-2 mb-3 bg-white border-top border-danger border-3 shadow">
                            <div>
                                <h4 class="text-info text-break"><?= $createdPoke['nombre'] ?></h4>
                                <div>
                                    <img src="../img/types/<?= $createdPoke['tipo_1'] ?>.jpg" alt="<?= $createdPoke['tipo_1'] ?>" class="poke-card__type">
                                    <img src="../img/types/<?= $createdPoke['tipo_2'] ?>.jpg" alt="<?= $createdPoke['tipo_2'] ?>" class="poke-card__type">

                                </div>
                            </div>
                            <div class="h-100 d-flex">
                                <img src="../img/pokemons/<?= $createdPoke['ruta_imagen'] ?>" class="align-self-center me-2 poke-card__img" alt="<?= $createdPoke['nombre'] ?>">
                                <span class="small">#<?= $createdPoke['numero'] ?></span>
                            </div>
                        </div>
                    </a>

                </div>
            <?php } else { ?>
                <h2>Error, reintente nuevamente.</h2>
                <img src="../img/sad-psy.png" alt="crying psyduck" class="img-fluid">
            <?php } ?>

        </div>
    </div>
</div>


<?php include_once("./componentes/foot.php") ?>