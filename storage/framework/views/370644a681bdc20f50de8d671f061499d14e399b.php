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
                              <form id="form_editado">
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
                                              <label>Area</label>
                                              <input class="form-control"  type="text" name="area_i" id="area_i">
                                          </div>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>BANCA</label>
                                              <samp id="banca_i_d"></samp>
                                              <select class="form-control"  type="text" name="banca_i" id="banca_i">
                                                <option disabled selected="true">Seleccionar Banca</option>
                                                <option value="BE">Banca Empresa</option>
                                                <option value="BPE">Banca Pequeña Empresa</option>
                                                <option value="BC">Banca Corporativa</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>ROL</label>
                                              <samp id="rol_i_d"></samp>
                                              <select class="form-control"  type="text" name="rol_i" id="rol_i"></select>
                                          </div>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>ZONA</label>
                                              <samp id="zona_i_d"></samp>
                                              <select class="form-control"  type="text" name="zona_i" id="zona_i"></select>
                                          </div>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label id="lacenje_i">CENTRO</label>
                                              <samp id="centro_i_d"></samp>
                                              <select class="form-control"  type="text" name="centro_i" id="centro_i"></select>
                                          </div>
                                      </div>
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                          <div class="col-md-8 col-sm-4 col-xs-12">
                                              <label>TIENDA</label>
                                              <samp id="tienda_i_d"></samp>
                                              <select class="form-control"  type="text" name="tienda_i" id="tienda_i"></select>
                                          </div>
                                      </div>

                                      <div class="form-group col-md-12 col-sm-12 col-xs-12" align="right">
                                          <button class="btn btn-primary editar" type="submit">Editar</button>
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
<script>
    $(document).on('change','#banca_i',function() {
        banca = $(this).val();$("#zona_i").html("");$("#centro_i").html("");$("#tienda_i").html("");
        if (banca=="BPE") {
            $("#lacenje_i").html("Centro");
        }else{
            $("#lacenje_i").html("Jefatura");
        }
        $.ajax({
            type: "POST",
            data: 'banca='+banca,
            url: APP_URL + 'addusuario/addusuario/comboZonas',
            dataType: 'json',
            beforeSend: function() {
            },
            success: function (json) {
                if (banca=="BPE") {
                    if (json.length>0) {
                      $("#zona_i").html("<option value='' selected='true'>Todos</option>");
                      $.each(json, function (key, value) {
                        $("#zona_i").append($("<option></option>")
                            .attr("value", value.ID_ZONA).text(value.ZONA));
                      });
                    }else{
                        $("#zona_i").html("<option value='' selected='true'>Todos</option>");
                    }
                }else{
                    if (json.length>0) {
                      $("#zona_i").html("<option value='' selected='true'>Todos</option>");
                      $.each(json, function (key, value) {
                        $("#zona_i").append($("<option></option>")
                            .attr("value", value.ID_ZONAL).text(value.ZONAL));
                      });
                    }else{
                        $("#zona_i").html("<option value='' selected='true'>Todos</option>");
                    }
                }
            },
            complete:function() {
            }
        });

        $.ajax({
            type: "POST",
            data: 'banca='+banca,
            url: APP_URL + 'addusuario/addusuario/comboRoles',
            dataType: 'json',
            beforeSend: function() {
            },
            success: function (json) {
                //20-31
                if (banca=="BE" || banca=="BC") {
                    if (json.length>0) {
                      $("#rol_i").html("<option value='' selected='true'>Todos</option>");
                      $.each(json, function (key, value) {
                          $("#rol_i").append($("<option></option>")
                              .attr("value", value.ID_ROL).text(value.NOMBRE));
                      });
                    }else{
                        $("#rol_i").html("<option value='' selected='true'>Todos</option>");
                    }
                }else{
                  //1-10
                    if (json.length>0) {
                      $("#rol_i").html("<option value='' selected='true'>Todos</option>");
                      $.each(json, function (key, value) {
                          $("#rol_i").append($("<option></option>")
                              .attr("value", value.ID_ROL).text(value.NOMBRE));
                      });
                    }else{
                        $("#rol_i").html("<option value='' selected='true'>Todos</option>");
                    }
                }
            },
            complete:function() {
            }
        });
    })

    $(document).on('change','#zona_i',function () {
        id_zonal=$(this).val();$("#centro_i").html("");$("#tienda_i").html("");
        banca = $("#banca_i").val();
        if (banca=="BE" || banca=="BC") {
            $.ajax({
              type: "POST",
              data: 'id_zonal='+id_zonal,
              url: APP_URL + 'addusuario/addusuario/comboJefaturas',
              dataType: 'json',
              beforeSend: function() {
              },
              success: function (json) {
                  if (json.length>0) {
                      $("#centro_i").html("<option value='' selected='true'>Todos</option>");
                      $.each(json, function (key, value) {
                        $("#centro_i").append($("<option></option>")
                            .attr("value", value.ID_JEFATURA).text(value.JEFATURA));
                      });
                  }else{
                      $("#centro_i").html("<option value='' selected='true'>Todos</option>");
                  }
              },
              complete:function() {
              }
            });
        }else{
          $.ajax({
            type: "POST",
            data: 'id_zonal='+id_zonal,
            url: APP_URL + 'addusuario/addusuario/comboCentros',
            dataType: 'json',
            beforeSend: function() {
            },
            success: function (json) {
                if (json.length>0) {
                    $("#centro_i").html("<option value='' selected='true'>Todos</option>");
                      $.each(json, function (key, value) {
                        $("#centro_i").append($("<option></option>")
                            .attr("value", value.ID_CENTRO).text(value.CENTRO));
                      });
                }else{
                    $("#centro_i").html("<option value='' selected='true'>Todos</option>");
                }
            },
            complete:function() {
            }
          });
        }
    })

    $(document).on('change','#centro_i',function () {
      centro = $(this).val();console.log(centro);$("#tienda_i").html("");
      banca = $("#banca_i").val();
      if (banca=="BPE") {
            $.ajax({
              type: "POST",
              data: 'id_centro='+centro,
              url: APP_URL + 'addusuario/addusuario/comboTiendas',
              dataType: 'json',
              beforeSend: function() {
              },
              success: function (json) {
                  if (json.length>0) {
                      $("#tienda_i").html("<option value='' disabled selected='true'>Todos</option>");
                      $.each(json, function (key, value) {
                        $("#tienda_i").append($("<option></option>")
                            .attr("value", value.ID_TIENDA).text(value.TIENDA));
                      });
                  }else{
                      $("#tienda_i").html("<option value='' selected='true'>Todos</option>");
                  }
              },
              complete:function() {
              }
            });
      }else{
        $("#tienda_i").html("<option value='' selected='true'>Todos</option>");
      }
    })
  $(document).on('click','.editar',function (argument) {
      $.ajax({
        type: "POST",
        data: $("#form_editado").serialize(),
        url: APP_URL + 'addusuario/addusuario/editarUsuario',
        dataType: 'json',
        beforeSend: function() {
        },
        success: function (json) {
        },
        complete:function() {
        }
      });
  })
</script>