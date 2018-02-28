<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Bandeja política</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>home">Inicio</a>
            </li>
            <li class="active">
                <strong>Bandeja política</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Bandeja política </h5>
                    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tab_politico" class="table table-striped table-bordered dt-responsive table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Solicitante</th>
                                    <th>Mensaje</th>
                                    <th>Fecha</th>
                                    <th>Asignación</th>
                                    <th>Bot</th>
                                    <th>Observación</th>
                                </tr>
                            </thead>
							
                        </table>
                        <!-- Campos ocultos de id y nombre del twitter -->
                        <input type="hidden" id="id_str">
						<input type="hidden" id="screen_name">
						<input type="hidden" id="ruta_origen" value="bandeja_politico">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para descripción del movimiento -->
<div class="modal fade" id="modal_detalles">
   <div class="modal-dialog">
	  <div class="modal-content">
		 <div class="modal-header" style="background-color:#1ab394">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" style="color:#ffffff">
			   <center>
				<span class="glyphicon glyphicon-search"></span>
				&nbsp;Indique los detalles de la asignación
			   </center>
			</h4>
		 </div>
		 <div class="modal-body">
			<form id="f_detalles" name="f_detalles" action="" method="post">
				<div class="form-group">
			   		<div class="col-sm-12">
			   			<button title="Seleccionar Situaciones..." type="button" class="btn btn-outline btn-primary list-situacion">Indicar Situación</button>
			   		</div>
			   </div>
			   <br/>
			   <br/>
			   <div class="form-group">
					<div class="col-sm-12">
						<div class="form-group">
							<label style="font-weight:bold;">Detalles</label>
							<textarea class="form-control" id="detalles"></textarea>
							<input type="hidden" id="id_tweet">
							<input type="hidden" id="nueva_bandeja">
							<input type="hidden" id="get_ids">
						</div>
					</div>
					</br></br>
					</br></br>
					<div class="col-sm-12" align="right">
						<span class="input-btn">
							<button class="btn btn-primary" type="button" id="asignar">
								Asignar&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
							</button>
							<button class="btn btn-primary" type="button" id="observar">
								Observar&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
							</button>
						</span>
					</div>
					</br></br>
			   </div>
			</form>
		 </div>
		 
	  </div>
   </div>
</div>
<!-- Cierre Modal para descripción del movimiento -->

<!-- Apertura Modal lista de situaciones -->
<div class="modal fade" id="modal_situaciones">
   <div class="modal-dialog">
	  <div class="modal-content">
		 <div class="modal-header" style="background-color:#1ab394">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" style="color:#ffffff">
			   <center>
				<span class="glyphicon glyphicon-search"></span>
				&nbsp;Indique las situaciones
			   </center>
			</h4>
		 </div>
		 <div class="modal-body" style="height: 320px;">
			<table id="tab_situaciones" class="table table-striped table-bordered dt-responsive table-hover dataTables-example" style="width: 100% !important;">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Situación</th>
                    </tr>
                </thead>
                <tbody>
                	<?php foreach ($situacion as $key => $value) { ?>
	                	<tr>
	                        <td>
	                        	<input type="checkbox" class="check" value="<?php echo $value->id;?>">
	                        </td>
	                        <td>
	                        	<?php echo $value->name;?>
	                        </td>
	                    </tr>
                    <?php }?>
                </tbody>
            </table>
		 </div>
		 
	  </div>
   </div>
</div>
<!-- Fin Modal lista de situaciones -->

 <!-- Page-Level Scripts -->
<script src="<?php echo assets_url(); ?>script/bandeja_politico.js"></script>
