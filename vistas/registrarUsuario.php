<?php
include_once ("./componentes/header.php");
//include_once ("./componentes/foot.php");


?>

<div style="display: flex; justify-content: center"  >

    <form action="validarRegistrarUsuario.php"  method="get"  style="width: 50%">

        <div class="input-group mb-3" >
            <input type="text" class="form-control" name="usuario" placeholder="Usuario" aria-label="usuario" required>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="contraseña" placeholder="Contraseña" aria-label="contraseña" required>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="repitecontraseña" placeholder="Repita su Contraseña" aria-label="repite contraseña" required>
        </div>
        <div class="modal-footer" style="text-align: center">
            <button  type="submit"  value="submit" class="btn btn-outline-primary">Registrarme</button>
        </div>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
