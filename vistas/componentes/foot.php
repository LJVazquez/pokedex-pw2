 <!-- modal de login -->

 <div class="modal fade" id="modal-login" tabindex="-1" aria-labelledby="modal-login-label" aria-hidden="true">
     <div class="modal-dialog">
         <form action="" class="modal-content" method="POST">

             <div class="modal-header bg-danger">
                 <h5 class="modal-title text-white" id="modal-login-label">Inicie Sesión para modificar Pokemones</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="input-group mb-3">
                     <input type="text" class="form-control" name="user" placeholder="Usuario" aria-label="usuario" required>
                 </div>
                 <div class="input-group mb-3">
                     <input type="password" class="form-control" name="password" placeholder="Contraseña" aria-label="contraseña" required>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="submit" name="submit" value="submit" class="btn btn-outline-danger">Login</button>
             </div>
         </form>
     </div>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
 </body>

 </html>