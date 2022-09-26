<?php include_once("./componentes/header.php");
include_once("../utils/bd.php");
include_once("verificaeSesion.php");

$pokeDb = new PokeBd();
$pokeId = $_GET['id'];
$poke = $pokeDb->fetchPokemonById($pokeId);

$previousData = $_SESSION['data'] ?? [];
$errors = $_SESSION['errors'] ?? [];
$messages = $_SESSION['messages'] ?? [];
?>

<div class="container mt-5">
    <div class="row">
        <?php if (isset($poke)) { ?>
            <div class="col-12 col-lg-6">
                <img src="../img/pokemons/<?= $poke['ruta_imagen'] ?>" alt="<?= $poke['nombre'] ?>" class="detail__img">
            </div>
            <div class="col-12 col-lg-6">
                <div class="h-100 bg-white p-3 border-top border-danger border-3 shadow d-flex flex-column justify-content-around">
                    <div>
                        <h1>#<?= $poke['numero'] . "- " . $poke['nombre'] ?></h1>
                        <div class="d-flex mb-3">
                            <img src="../img/types/<?= $poke['tipo_1'] ?>.jpg" alt="<?= $poke['tipo_1'] ?>" class="poke-card__type me-2">
                            <img src="../img/types/<?= $poke['tipo_2'] ?>.jpg" alt="<?= $poke['tipo_2'] ?>" class="poke-card__type">
                        </div>
                    </div>
                    <div>
                        <h4>
                            <img src="../img/habilidadEspecial.jpg" alt="habilidad" class="detail__attack-icon">
                            Descripcion
                        </h4>
                        <p><?= $poke['descripcion'] ?></p>
                    </div>
                    <div>
                        <a href="./edit.php?id=<?= $poke['id'] ?>" class="btn btn-secondary">Editar</a>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete">
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        <?php } else { ?>

            <div class="text-center">
                <h2 class="lead fw-bold">Pokemon no encontrado</h2>
                <img src="../img/404.png" alt="404" class="image-fluid mb-3" height="400">
                <h2>¡No lo pudimos atrapar! :(</h2>
            </div>
        <?php  } ?>

        <!-- modal de confirmar delete -->

        <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-delete-label" aria-hidden="true">
            <div class="modal-dialog">
                <form action="./delete.php" class="modal-content" method="POST">

                    <input type="hidden" name="id" value="<?= $poke['id'] ?>">

                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="modal-delete-label">¿Borrar pokemon?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Realmente queres borrar este Pokemon? Esta accion no tiene vuelta atras.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="submit" value="submit" class="btn btn-danger">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include_once("./componentes/foot.php");
unset($_SESSION['data']);
unset($_SESSION['errors']);
unset($_SESSION['messages']);
?>