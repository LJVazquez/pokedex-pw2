<?php include_once("./componentes/header.php");
include_once("../utils/bd.php");
$pokeDb = new PokeBd();
$searchParam = '';

if (isset($_GET['searchParam'])) {
    $searchParam = $_GET['searchParam'];
}

$pokeData = $pokeDb->searchPokemons($searchParam);
?>


<div class="container mt-5">

    <h2 class="subtitle mb-3<?= isset($pokeData) ?  '' : 'text-center' ?>">
        <?= isset($pokeData) ?  'Resultados de la busqueda:' : 'Sin resultados :(' ?>
    </h2>
    <div class=" row">
        <?php if (isset($pokeData)) { ?>

            <?php foreach ($pokeData as $poke) { ?>
                <div class="col-6 col-lg-4 col-xl-3">
                    <a href="./detail.php?id=<?= $poke['id'] ?>" class="text-decoration-none">
                        <div class="poke-card d-flex align-items-center justify-content-between p-2 mb-3 bg-white border-top border-danger border-3 shadow">
                            <div>
                                <h4 class="text-info text-break"><?= $poke['nombre'] ?></h4>
                                <div>
                                    <img src="../img/types/<?= $poke['tipo_1'] ?>.jpg" alt="<?= $poke['tipo_1'] ?>" class="poke-card__type">
                                    <img src="../img/types/<?= $poke['tipo_2'] ?>.jpg" alt="<?= $poke['tipo_2'] ?>" class="poke-card__type">

                                </div>
                            </div>
                            <div class="h-100 d-flex">
                                <img src="../img/pokemons/<?= $poke['ruta_imagen'] ?>" class="align-self-center poke-card__img" alt="<?= $poke['nombre'] ?>">
                                <span class="small">#<?= $poke['numero'] ?></span>
                            </div>
                        </div>
                    </a>

                </div>
            <?php } ?>

        <?php } else { ?>
            <div class="col-12 text-center">
                <img src="../img/sad-psy.png" alt="crying psyduck" class="img-fluid">
            </div>
        <?php } ?>

    </div>
</div>

<?php include_once("./componentes/foot.php") ?>