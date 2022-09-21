<?php
include_once("./componentes/header.php");
include_once("../utils/bd.php");

$pokeBd = new PokeBd();
$types = $pokeBd->fetchTypes();

session_start();
$previousData = $_SESSION['data'] ?? [];
$errors = $_SESSION['errors'] ?? [];

?>

<div class="container">

    <?php if (in_array('carga', $errors)) { ?>
        <div class="alert alert-danger py-1">
            Error en la carga, reintente por favor.
        </div>
    <?php } ?>

    <form action="./create_res.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-9">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control <?= in_array('nombre', $errors) ? 'is-invalid' : '' ?> " id="nombre" name="nombre" value="<?= $previousData['nombre'] ?? '' ?>">
                <?php if (in_array('nombre', $errors)) { ?>
                    <div class="form-text text-danger">Por favor ingrese un nombre valido</div>
                <?php } ?>
            </div>
            <div class="col-3">
                <label for="numero" class="form-label">Numero</label>
                <input type="number" class="form-control <?= in_array('numero', $errors) ? 'is-invalid' : '' ?>" id="numero" name="numero" value="<?= $previousData['numero'] ?? '' ?>">
                <?php if (in_array('numero', $errors)) { ?>
                    <div class="form-text text-danger">Por favor ingrese un numero valido</div>
                <?php } ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcion</label>
            <input type="text" class="form-control <?= in_array('descripcion', $errors) ? 'is-invalid' : '' ?>" id="descripcion" name="descripcion" value="<?= $previousData['descripcion'] ?? '' ?>">
            <?php if (in_array('descripcion', $errors)) { ?>
                <div class="form-text text-danger">Por favor ingrese una descripcion valida</div>
            <?php } ?>
        </div>

        <label for="descripcion" class="form-label">Tipo 1</label>
        <select class="form-select mb-3" name="tipo_1">
            <?php foreach ($types as $type) { ?>
                <option value="<?= $type['id'] ?>" <?= isset($previousData['tipo_1']) && $previousData['tipo_1'] === $type['id'] ? 'selected' : '' ?>>
                    <?= $type['nombre'][0] . strtolower(substr($type['nombre'], 1)) ?></option>
            <?php } ?>
        </select>

        <label for="descripcion" class="form-label">Tipo 2</label>
        <select class="form-select mb-3" name="tipo_2">
            <option value="0">Ninguno</option>
            <?php foreach ($types as $type) { ?>
                <option value="<?= $type['id'] ?>" <?= isset($previousData['tipo_2']) && $previousData['tipo_2'] === $type['id'] ? 'selected' : '' ?>>
                    <?= $type['nombre'][0] . strtolower(substr($type['nombre'], 1)) ?></option>
            <?php } ?>
        </select>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input class="form-control <?= in_array('imagen', $errors) ? 'is-invalid' : '' ?>" type="file" id="imagen" name="imagen">
            <?php if (in_array('imagen', $errors)) { ?>
                <div class="form-text text-danger">Por favor seleccione una imagen valida</div>
            <?php } ?>
        </div>

        <button type="submit" name="submit" value="submit" class="btn btn-danger">Agregar</button>
    </form>
</div>

<?php include_once("./componentes/foot.php");
unset($_SESSION['data']);
unset($_SESSION['errors']);
unset($_SESSION['messages']);
?>