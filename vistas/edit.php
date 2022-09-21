<?php
include_once("./componentes/header.php");
include_once("../utils/bd.php");

$pokeBd = new PokeBd();
$types = $pokeBd->fetchTypes();
$pokeId = $_GET['id'];
$poke = $pokeBd->fetchPokemonById($pokeId);


session_start();
$previousData = $_SESSION['data'] ?? [];
$errors = $_SESSION['errors'] ?? [];
$messages = $_SESSION['messages'] ?? [];

?>

<div class="container">

    <?php if (!isset($poke)) { ?>
        <div class="text-center">
            <h2 class="lead fw-bold">Pokemon no encontrado</h2>
            <img src="../img/404.png" alt="404" class="image-fluid mb-3" height="400">
            <h2>¡No lo pudimos atrapar! :(</h2>
        </div>
    <?php } else { ?>


        <?php if (in_array('carga', $errors)) { ?>
            <div class="alert alert-danger py-1">
                Error en la carga, reintente por favor.
            </div>
        <?php } else ?>

        <?php if (in_array('no_actualizado', $messages)) { ?>
            <div class="alert alert-danger py-1">
                Error en la actualizacion, reintente por favor.
            </div>
        <?php } else ?>

        <form action="./edit_res.php" method="POST" enctype="multipart/form-data">

            <?php if (in_array('actualizado', $messages)) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ¡Pokemon actualizado con exito!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>

            <input type="hidden" name="id" value="<?= $poke['id'] ?>">
            <input type="hidden" name="ruta_imagen_actual" value="<?= $poke['ruta_imagen'] ?>">

            <div class="row">
                <div class="col-9">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control <?= in_array('nombre', $errors) ? 'is-invalid' : '' ?> " id="nombre" name="nombre" value="<?= $previousData['nombre'] ?? $poke['nombre'] ?>">
                    <?php if (in_array('nombre', $errors)) { ?>
                        <div class="form-text text-danger">Por favor ingrese un nombre valido</div>
                    <?php } ?>
                </div>
                <div class="col-3">
                    <label for="numero" class="form-label">Numero</label>
                    <input type="number" class="form-control <?= in_array('numero', $errors) ? 'is-invalid' : '' ?>" id="numero" name="numero" value="<?= $previousData['numero'] ?? $poke['numero'] ?>">
                    <?php if (in_array('numero', $errors)) { ?>
                        <div class="form-text text-danger">Por favor ingrese un numero valido</div>
                    <?php } ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" class="form-control <?= in_array('descripcion', $errors) ? 'is-invalid' : '' ?>" id="descripcion" name="descripcion" value="<?= $previousData['descripcion'] ?? $poke['descripcion'] ?>">
                <?php if (in_array('descripcion', $errors)) { ?>
                    <div class="form-text text-danger">Por favor ingrese una descripcion valida</div>
                <?php } ?>
            </div>

            <label for="descripcion" class="form-label">Tipo 1</label>
            <select class="form-select mb-3" name="tipo_1">
                <?php foreach ($types as $type) { ?>
                    <option value="<?= $type['id'] ?>" <?= $poke['tipo_1'] === $type['nombre'] ? 'selected' : '' ?>>
                        <?= $type['nombre'][0] . strtolower(substr($type['nombre'], 1)) ?></option>
                <?php } ?>
            </select>

            <label for="descripcion" class="form-label">Tipo 2</label>
            <select class="form-select mb-3" name="tipo_2">
                <option value="0">Ninguno</option>
                <?php foreach ($types as $type) { ?>
                    <option value="<?= $type['id'] ?>" <?= $poke['tipo_2'] === $type['nombre'] ? 'selected' : '' ?>>
                        <?= $type['nombre'][0] . strtolower(substr($type['nombre'], 1)) ?></option>
                <?php } ?>
            </select>


            <div class="d-flex align-items-center mb-3">
                <img src="../img/pokemons/<?= $poke['ruta_imagen'] ?>" alt="<?= $poke['nombre'] ?>" height="75" class="me-3">
                <div>
                    <label for="imagen" class="form-label">Imagen actual</label>
                    <input class="form-control <?= in_array('imagen', $errors) ? 'is-invalid' : '' ?>" type="file" id="imagen" name="imagen">
                </div>
                <?php if (in_array('imagen', $errors)) { ?>
                    <div class="form-text text-danger">Por favor seleccione una imagen valida</div>
                <?php } ?>
            </div>

            <button type="submit" name="submit" value="submit" class="btn btn-danger">Confirmar</button>
            <a href="./detail.php?id=<?= $poke['id'] ?>" class="btn btn-secondary">Ver pokemon</a>
        </form>
    <?php } ?>

</div>

<?php include_once("./componentes/foot.php");
unset($_SESSION['data']);
unset($_SESSION['errors']);
unset($_SESSION['messages']);
?>