<?php
include_once("./componentes/header.php");
include_once("./componentes/foot.php");

$loginError = $_SESSION['login_error'] ?? [];

?>

<div class="container">

    <form action="./validarLogin.php" method="get" class="w-50 m-auto">


        <?php if (isset($_SESSION["login_error"])) { ?>
            <div class="alert alert-danger">Usuario o contraseña incorrecto</div>
        <?php } ?>

        <div class="input-group mb-3">
            <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="contraseña" placeholder="Contraseña" required>
        </div>
        <div class="modal-footer" style="text-align: center">
            <button type="submit" value="submit" class="btn btn-outline-danger">Login</button>
        </div>
    </form>
</div>

<?php include_once("./componentes/foot.php");
unset($_SESSION['login_error']);
?>