
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Bandeja de entrada</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>home">Inicio</a>
            </li>
            <li class="active">
                <strong>Bandeja de entrada</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Bandeja de entrada </h5>
                    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tab_entradas" class="table table-striped table-bordered dt-responsive table-hover dataTables-example" >
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
						<input type="hidden" id="ruta_origen" value="bandeja_entrada">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
	<div class="pull-right">
	</div>
	<div><strong></strong> Puesto Comando Aragua &copy; 2017</div>
</div>

<!-- Modal para descripción del movimiento -->

	<div class="modal fade" id="modal_detalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden=true data-backdrop="static" data-keyboard="false">
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
		 <div class="modal-body" style="height: 200px;">
			<form id="f_detalles" name="f_detalles" action="" method="post">
					<div class="col-sm-12">
						<div class="form-group">
							<label style="font-weight:bold;">Detalles</label>
							<textarea class="form-control" id="detalles"></textarea>
							<input type="hidden" id="id_tweet">
							<input type="hidden" id="nueva_bandeja">
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

<!-- Fin Modal lista de situaciones -->

 <!-- Page-Level Scripts -->
<script src="<?php echo assets_url(); ?>script/bandeja_entradas.js"></script>