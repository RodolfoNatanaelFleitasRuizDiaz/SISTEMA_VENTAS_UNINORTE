<div id="modalmantenimiento" class="modal fade">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content bd-0 tx-14">
      <form method="post" id="usuario_form">
        <div class="modal-header pd-y-20 pd-x-25">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="mdltitulo"></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body pd-25">
          <input type="hidden" name="usu_id" id="usu_id">

          <div class="form-group">
            <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="usu_nom" id="usu_nom" 
                   placeholder="Ingrese Nombre" required>
          </div>

          <div class="form-group">
            <label class="form-control-label">Usuario (Sesión): <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="usu_sesion" id="usu_sesion" 
                   placeholder="Ingrese Usuario de sesión" required>
          </div>

          <div class="form-group">
            <label class="form-control-label">Contraseña: <span class="tx-danger" id="label_clave">*</span></label>
            <input class="form-control" type="password" name="usu_clave" id="usu_clave" 
                   placeholder="Ingrese Contraseña">
            <small class="form-text text-muted" id="ayuda_clave">
              Deje en blanco si no desea cambiar la contraseña
            </small>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" name="action" id="btnGuardar" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>