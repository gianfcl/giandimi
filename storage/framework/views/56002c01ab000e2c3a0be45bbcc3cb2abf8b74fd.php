<script type="text/javascript"  src="<?php echo e(URL::asset('js/jquery-1.12.4.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap.min.js')); ?>"></script>       
<script type="text/javascript" src="<?php echo e(URL::asset('js/impl.js?v001')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/typeahead.bundle.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/formValidation.popular.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/language/es_CL.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/formvalidation/framework/bootstrap.min.js')); ?>"></script>
<script>
    $(document).on('change','#banca',function() {
        banca = $(this).val();$("#zona").html("");$("#centro").html("");$("#tienda").html("");
        if (banca=="BPE") {
            $("#lacenje").html("Centro");
        }else{
            $("#lacenje").html("Jefatura");
        }
        $.ajax({
            type: "POST",
            data: 'banca='+banca,
            url: APP_URL + 'addusuario/comboZonas',
            dataType: 'json',
            beforeSend: function() {
            },
            success: function (json) {
                if (banca=="BPE") {
                    if (json.length>0) {
                    $("#zona").html("<option value='' selected='true'>Todos</option>");
                    $.each(json, function (key, value) {
                            $("#zona").append($("<option></option>")
                                .attr("value", value.ID_ZONA).text(value.ZONA));
                        });
                    }else{
                        $("#zona").html("<option value='' selected='true'>Todos</option>");
                    }
                }else{
                    if (json.length>0) {
                    $("#zona").html("<option value='' selected='true'>Todos</option>");
                    $.each(json, function (key, value) {
                            $("#zona").append($("<option></option>")
                                .attr("value", value.ID_ZONAL).text(value.ZONAL));
                        });
                    }else{
                        $("#zona").html("<option value='' selected='true'>Todos</option>");
                    }
                }
            },
            complete:function() {
            }
        });

        $.ajax({
            type: "POST",
            data: 'banca='+banca,
            url: APP_URL + 'addusuario/comboRoles',
            dataType: 'json',
            beforeSend: function() {
            },
            success: function (json) {
                //20-31
                if (banca=="BE" || banca=="BC") {
                    if (json.length>0) {
                    $("#rol").html("<option value='' selected='true'>Todos</option>");
                    $.each(json, function (key, value) {
                            $("#rol").append($("<option></option>")
                                .attr("value", value.ID_ROL).text(value.NOMBRE));
                        });
                    }else{
                        $("#rol").html("<option value='' selected='true'>Todos</option>");
                    }
                }else{
                  //1-10
                    if (json.length>0) {
                    $("#rol").html("<option value='' selected='true'>Todos</option>");
                    $.each(json, function (key, value) {
                            $("#rol").append($("<option></option>")
                                .attr("value", value.ID_ROL).text(value.NOMBRE));
                        });
                    }else{
                        $("#rol").html("<option value='' selected='true'>Todos</option>");
                    }
                }
            },
            complete:function() {
            }
        });
    })

    $(document).on('change','#zona',function () {
        id_zonal=$(this).val();$("#centro").html("");$("#tienda").html("");
        banca = $("#banca").val();
        if (banca=="BE" || banca=="BC") {
            $.ajax({
              type: "POST",
              data: 'id_zonal='+id_zonal,
              url: APP_URL + 'addusuario/comboJefaturas',
              dataType: 'json',
              beforeSend: function() {
              },
              success: function (json) {
                  if (json.length>0) {
                      $("#centro").html("<option value='' selected='true'>Todos</option>");
                      $.each(json, function (key, value) {
                          $("#centro").append($("<option></option>")
                              .attr("value", value.ID_JEFATURA).text(value.JEFATURA));
                      });
                  }else{
                      $("#centro").html("<option value='' selected='true'>Todos</option>");
                  }
              },
              complete:function() {
              }
            });
        }else{
          $.ajax({
            type: "POST",
            data: 'id_zonal='+id_zonal,
            url: APP_URL + 'addusuario/comboCentros',
            dataType: 'json',
            beforeSend: function() {
            },
            success: function (json) {
                if (json.length>0) {
                    $("#centro").html("<option value='' selected='true'>Todos</option>");
                      $.each(json, function (key, value) {
                          $("#centro").append($("<option></option>")
                              .attr("value", value.ID_CENTRO).text(value.CENTRO));
                      });
                }else{
                    $("#centro").html("<option value='' selected='true'>Todos</option>");
                }
            },
            complete:function() {
            }
          });
        }
    })

    $(document).on('change','#centro',function () {
      centro = $(this).val();console.log(centro);$("#tienda").html("");
      banca = $("#banca").val();
      if (banca=="BPE") {
            $.ajax({
              type: "POST",
              data: 'id_centro='+centro,
              url: APP_URL + 'addusuario/comboTiendas',
              dataType: 'json',
              beforeSend: function() {
              },
              success: function (json) {
                  if (json.length>0) {
                      $("#tienda").html("<option value='' disabled selected='true'>Todos</option>");
                      $.each(json, function (key, value) {
                          $("#tienda").append($("<option></option>")
                              .attr("value", value.ID_TIENDA).text(value.TIENDA));
                      });
                  }else{
                      $("#tienda").html("<option value='' selected='true'>Todos</option>");
                  }
              },
              complete:function() {
              }
            });
      }else{
        $("#tienda").html("<option value='' selected='true'>Todos</option>");
      }
    })
</script>


<div class="modal fade" id="add_usu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Agregar Usuario<b id="edit_usu"></b></h4>
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
                              <form action="<?php echo e(route('addusuario.lista.index')); ?>" id="frmAddusuario" class="frmAddusuario" method="POST">
                                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                      <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                          <label>Nombre</label>
                                          <input class="form-control" placeholder="Nombre Usuario" required="" type="text" name="nombre_j" id="nombre_j">
                                      </div> 
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                          <label>Registro</label>
                                          <input class="form-control" placeholder="Registro" required="" type="text" name="registro" id="registro">
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                          <label>DNI</label>
                                          <input class="form-control" placeholder="DNI" type="text" name="dni" id="dni">
                                      </div>
                                  </div>

                                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                          <label>Cargo</label>
                                          <input class="form-control" placeholder="Cargo" required="" type="text" name="cargo" id="cargo">
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                          <label>Area</label>
                                          <input class="form-control" placeholder="Area" required="" type="text" name="area" id="area">
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                          <label>Banca</label>
                                          <select class="form-control" placeholder="Banca" required="" type="text" name="banca" id="banca">
                                              <option disabled selected="true">Seleccionar Banca</option>
                                              <option value="BE">Banca Empresa</option>
                                              <option value="BPE">Banca Pequeña Empresa</option>
                                              <option value="BC">Banca Corporativa</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                          <label>Rol</label>
                                          <select class="form-control" placeholder="Rol" required="" type="text" name="rol" id="rol">
                                          </select>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                          <label>ZONA</label>
                                          <select class="form-control" placeholder="Zona" required="" type="text" name="zona" id="zona">
                                          </select>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                          <label id="lacenje">CENTRO/JEFATURA</label>
                                          <select class="form-control" placeholder="Centro" value="" type="text" name="centro" id="centro">
                                          </select>
                                      </div>
                                  </div>

                                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                      <div class="col-md-4 col-sm-4 col-xs-12">
                                          <label>TIENDA</label>
                                          <select class="form-control" placeholder="Tienda" type="text" name="tienda" id="tienda">  
                                          </select>
                                      </div>
                                  </div>

                                  <br><br><br><br>
                                  <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                      <button class="btn btn-primary" type="button">Añadir</button>
                                  </div>
                                  <div class="clearfix"></div>

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