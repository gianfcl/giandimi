<script type="text/javascript"  src="<?php echo e(URL::asset('js/jquery-1.12.4.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap.min.js')); ?>"></script>       
<script type="text/javascript" src="<?php echo e(URL::asset('js/impl.js?v001')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/typeahead.bundle.js')); ?>"></script>

<div class="modal fade" id="detalle_usu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Editar Usuario<b id="edit_usu"></b></h4>
        <!--?php if(isset($tabs)) { echo $tabs; } ?-->       
      </div>
      <div class="modal-body">
        <div class="row">
          <ul id="menu" class="nav nav-tabs" role="tablist">
          </ul>
          <div class="tab-content">
              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                          <div class="x_content">
                              <form>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>Nombre</label>
                                              <input class="form-control"  type="text" name="nombre_j_i" id="nombre_j_i">
                                          </div>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>Registro</label>
                                              <input class="form-control" readonly="" type="text" name="registro_i" id="registro_i">
                                          </div>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>DNI</label>
                                              <input class="form-control" readonly="" type="text" name="dni_i" id="dni_i">
                                          </div>
                                      </div>

                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>Contraseña</label>
                                              <input class="form-control" readonly="" type="password" name="passwordusu_i" id="passwordusu_i">
                                          </div>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>Cargo</label>
                                              <input class="form-control"  type="text" name="cargo_i" id="cargo_i">
                                          </div>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>Rol</label>
                                              <input class="form-control"  type="text" name="rol_i" id="rol_i">
                                          </div>
                                      </div>

                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>Area</label>
                                              <input class="form-control"  type="text" name="area_i" id="area_i">
                                          </div>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>CENTRO</label>
                                              <input class="form-control"  type="text" name="centro_i" id="centro_i">
                                          </div>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>BANCA</label>
                                              <input class="form-control"  type="text" name="banca_i" id="banca_i">
                                          </div>
                                      </div>

                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>ZONA</label>
                                              <input class="form-control"  type="text" name="zona_i" id="zona_i">
                                          </div>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>TIENDA</label>
                                              <input class="form-control"  type="text" name="tienda_i" id="tienda_i">
                                          </div>
                                      </div>

                                      <div class="form-group col-md-12 col-sm-12 col-xs-12" align="right">
                                          <button class="btn btn-primary" type="button">Editar</button>
                                      </div>
                              </form> 
                          </div>
                      </div>
                  </div>
              </div>

          </div>
        </div>
      </div>
      <div class="moda-footer"></div>
    </div>
  </div>
</div>