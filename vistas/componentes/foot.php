 <!-- modal de login -->

  <div class="modal fade" id="modal-login" tabindex="-1" aria-labelledby="modal-login-label" aria-hidden="true">
      <div class="modal-dialog">
          <form action="./login.php" class="modal-content" method="get">

         <div class="modal-header bg-danger">
                  <h5 class="modal-title text-white" id="modal-login-label">Iniciar Sesion</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
             <div class="modal-body">
                 <div class="input-group mb-3">
                     <input type="text" class="form-control" name="usuario" placeholder="Usuario" aria-label="usuario" required>
                 </div>
                 <div class="input-group mb-3">
                     <input type="text" class="form-control" name="contraseña" placeholder="Contraseña" aria-label="contraseña" required>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="submit"  value="submit" class="btn btn-outline-danger">Login</button>
             </div>
         </form>
     </div>
 </div>

 </body>

 </html>