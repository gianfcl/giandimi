<?php $__env->startSection('content'); ?>
<div class="dashboard_graph panelesdesign" style="margin-bottom: 3px;">

    <div class="row x_title">
        <div class="col-md-1"><i class="fa fa-table" "></i></div>
        <div class="col-md-11">
            <h3 class="titulocabecera"><B>ASIGNACION DE LEADS</B></h3>
        </div>

    </div>
   
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
             <div  style="margin-top: 15px;">
                 
                <form id="form-asignacion-uno"> 
                 <div class="row ">
			  	  <div class="col-xs-5"  >
                    <!--<label>RUC/DNI</label>-->
                    <input id="num_doc" type="text" class="form-control" placeholder="DNI/RUC">
           		   </div>
			  	  <div class="col-xs-5">
                    <!--<label>Nombre del Cliente</label>-->
                    <input id="nom_cli" type="text" class="form-control" placeholder="NOMBRE DEL CLIENTE">
           		   </div>
                    <div class="col-xs-2">
                        <label></label>
                        <button id="agregar" type="button" class="btn btn-default">Agregar</button>
                    </div>
                 </div>
                   </form>        
                <div class="table-responsive">
                         <table id="Asignacion" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nro.</th>
                                        <th>Cliente</th>
                                        <th>Ejecutivo</th>
                                        <th>Ubicación</th>
                                        <th>Canal</th>
                                        <th>Add</th>
                                    </tr>
                                </thead>
                            </table>
            </div>

                <form>
                    <div class="row ">
                    <H5>EJECUTIVO DE NEGOCIO A ASIGNAR</H5>
                          <div class="col-xs-5"  >
                    <!--<label>RUC/DNI</label>-->
                    <input type="text" class="form-control" placeholder="REGISTRO DEL EJECUTIVO">
                   </div>
                  <div class="col-xs-5">
                    <!--<label>Nombre del Cliente</label>-->
                    <input type="text" class="form-control" placeholder="NOMBRE DEL EJECUTIVO">
                   </div>
                    <div class="col-xs-2">
                        <label></label>
                        <button id="asignar" type="button" class="btn btn-default">Agregar</button>
                    </div>
                 </div>
                 </form>
        </div>
    </div>



    <div class="clearfix"></div>
</div>
<div id="prueba"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js-scripts'); ?>
 <script type="text/javascript" charset="utf8" src="<?php echo e(URL::asset('js/formvalidation/formValidation.min.js')); ?>"></script>
<script type="text/javascript" charset="utf8" src="<?php echo e(URL::asset('js/impl_paginas.js')); ?>"></script>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>