<!-- FooTable -->
<link href="<?php echo assets_url('css/plugins/footable/footable.core.css');?>" rel="stylesheet">

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Twitter details</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>home">Inicio</a>
            </li>
            <li>
                <a href="<?php echo base_url().$ruta_origen; ?>">Atrás</a>
            </li>
            <li class="active">
                <strong>Twitter details</strong>
            </li>
        </ol>
    </div>
</div>

<!-- Campo oculto que almacena el url base del proyecto -->
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

<!-- Cuerpo de la sección de cuenta de twitter -->
<div class="wrapper wrapper-content animated fadeInUp">
	<div class="row">
		<div class="col-lg-12">
			<div class="contact-box">				
				<div class="col-sm-2">
					<div class="text-center">
						<a href="profile.html">
							<img alt="image" class="img-circle m-t-xs img-responsive" src="<?php echo $profile_image_url; ?>">
						</a>
						<div class="m-t-xs font-bold">
							<a class="btn btn-primary btn-xs" href="https://twitter.com/<?php echo $screen_name; ?>" target="_blank">
								<i class="fa fa-twitter"></i> Ver en Twitter
							</a>
						</div>
						<div class="m-t-xs font-bold">
							<a class="btn btn-primary btn-xs" id="enviar_mensaje">
								<i class="fa fa-send"></i> Enviar mensaje
							</a>
							Recibidos: <span class="label label-info " title="<?php echo $num_mensajes?> mensajes"><?php echo $num_mensajes?></span>
						</div>
					</div>
				</div>
				<div class="col-sm-10">
					<h3><strong><?php echo $screen_name; ?></strong></h3>
					<p><?php echo $name; ?></p>
					<p><?php echo $location; ?></p>
					<p><strong><?php echo $url; ?></strong></p>
					<p><?php echo $description; ?></p>
				</div>
				<div class="clearfix"></div>
				
				<div class="contact-box-footer">
					<div>
						<div class="col-md-2 forum-info">
							<span class="views-number">
								<?php echo $statuses_count; ?>
							</span>
							<div>
								<small>Statuses</small>
							</div>
						</div>
						<div class="col-md-2 forum-info">
							<span class="views-number">
								<?php echo $favorites_count; ?>
							</span>
							<div>
								<small>Favorites</small>
							</div>
						</div>
						<div class="col-md-2 forum-info">
							<span class="views-number">
								<?php echo $listed_count; ?>
							</span>
							<div>
								<small>Listed</small>
							</div>
						</div>
						<div class="col-md-2 forum-info">
							<span class="views-number">
								<?php echo $friends_count; ?>
							</span>
							<div>
								<small>Friends</small>
							</div>
						</div>
						<div class="col-md-2 forum-info">
							<span class="views-number">
								<?php echo $followers_count; ?>
							</span>
							<div>
								<small>Followers</small>
							</div>
						</div>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Cierre del cuerpo de la sección de cuenta de twitter -->

<!-- Cuerpo de la sección de perfiles asociados -->
<div class="wrapper wrapper-content animated fadeInUp">

	<div class="ibox">
		<div class="ibox-title">
			<h5>Todos los perfiles asignados a esta cuenta</h5>
			<div class="ibox-tools">
				<a class="btn btn-primary btn-xs" id="boton_vincular">
				Crear nuevo perfil social
				</a>
			</div>
		</div>
		<div class="ibox-content">
			<!--<div class="row m-b-sm m-t-sm">
				<div class="col-md-1">
					<button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
				</div>
				<div class="col-md-11">
					<div class="input-group">
						<input type="text" placeholder="Search" class="input-sm form-control" ng-model="busqueda">
						<span class="input-group-btn">
						<button type="button" class="btn btn-sm btn-primary"> Go!</button> 
						</span>
					</div>
				</div>
				<div class="col-md-1">
					<smal> Buscando: {{busqueda}}</smal>
				</div>
			</div>-->

			<div class="project-list">
				
				<div class="table-responsive">
					<table id="tab_perfiles" class="table table-hover footable table-stripped toggle-arrow-tiny">
						
						<thead>
							<tr>

								<th data-toggle="true">Id</th>
								<th data-hide="phone">Cédula y nombre</th>
								<th data-hide="phone">Teléfono</th>
								<th data-hide="phone">Celular</th>
								<th data-hide="phone" >Correo</th>
								<th data-hide="all" >Centro de votación</th>
								<th data-hide="all" >Dirección del centro</th>
								<th class="text-right" data-sort-ignore="true">Acciones</th>

							</tr>
						</thead>
						
						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($perfiles as $perfil) { ?>
							<tr>
								<td class="project-status">
									<?php echo $perfil->id; ?>
								</td>
								<td class="project-title">
									<a ><?php echo $perfil->cedula; ?></a>
									<br/>
									<small><?php echo $perfil->nombre.' '.$perfil->apellido; ?></small>
								</td>
								<td class="project-title">
									<?php echo $perfil->telefono; ?>
								</td>
								<td class="project-title">
									<?php echo $perfil->celular; ?>
								</td>
								<td class="project-title">
									<?php echo $perfil->correo; ?>
								</td>
								<td class="project-title">
									<?php echo $perfil->centro_votacion; ?>
								</td>
								<td class="project-title">
									<?php echo $perfil->direccion_centro_votacion; ?>
								</td>
								<td class="project-actions">
									<a class="btn btn-white btn-sm ver" id="<?php echo $perfil->id.";".$id.";".$screen_name; ?>"><i class="fa fa-folder"></i> Ver </a>
									<a class="btn btn-white btn-sm editar" id="<?php echo $perfil->id.";".$id.";".$screen_name; ?>"><i class="fa fa-pencil"></i> Editar </a>
									<a class="btn btn-danger btn-sm quitar" id="<?php echo $perfil->id.";".$id; ?>"><i class="fa fa-trash"></i> Quitar </a>
								</td>
							</tr>
							<?php $i++ ?>
							<?php } ?>
						</tbody>
						
					</table>
					
				</div>
				
			</div>
		</div>
	</div>
</div>
<!-- Cierre del cuerpo de la sección de perfiles asociados -->

<!-- Modal para indicar la cédula del usuario -->
<div class="modal fade" id="modal_cedula">
   <div class="modal-dialog">
	  <div class="modal-content">
		 <div class="modal-header" style="background-color:#1ab394">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" style="color:#ffffff">
			   <center>
				<span class="glyphicon glyphicon-search"></span>
				&nbsp;Indique la cédula del usuario
			   </center>
			</h4>
		 </div>
		 <div class="modal-body">
			<form id="f_cedula" name="f_cedula" action="" method="post">
			   <div class="form-group">
					<div class="col-sm-12">
						<div class="form-group">
							<label style="font-weight:bold;">Cédula</label>
							<input type="text" class="form-control" id="cedula">
							<input type="hidden" id="id_twitter" value="<?php echo $id; ?>">
							<input type="hidden" id="screen_name" value="<?php echo $screen_name; ?>">
							<input type="hidden" id="ruta_origen" value="<?php echo $ruta_origen; ?>">
						</div>
					</div>
					</br></br>
					</br></br>
					<div class="col-sm-12" align="right">
						<span class="input-btn">
							<button class="btn btn-primary" type="button" id="vincular">
								Vincular&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
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
<!-- Cierre Modal para indicar la cédula del usuario -->

<!-- Modal para envío de mensaje directo -->
<div class="modal fade" id="modal_mensaje">
   <div class="modal-dialog">
	  <div class="modal-content">
		 <div class="modal-header" style="background-color:#1ab394">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" style="color:#ffffff">
			   <center>
				<span class="glyphicon glyphicon-search"></span>
				&nbsp;Indique el mensaje a enviar
			   </center>
			</h4>
		 </div>
		 <div class="modal-body">
			<form id="f_cedula" name="f_cedula" action="" method="post">
			   <div class="form-group">
					<div class="col-sm-12">
						<div class="form-group">
							<label style="font-weight:bold;">Mensaje</label>
							<textarea class="form-control" id="mensaje"></textarea>
							<input type="hidden" id="id_twitter" value="<?php echo $id; ?>">
							<input type="hidden" id="screen_name_message" value="<?php echo $screen_name; ?>">
							<input type="hidden" id="ruta_origen" value="<?php echo $ruta_origen; ?>">
						</div>
					</div>
					</br></br>
					</br></br>
					<div class="col-sm-12" align="right">
						<span class="input-btn">
							<button class="btn btn-primary" type="button" id="enviar">
								Enviar&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
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
<!-- Cierre Modal para envío de mensaje directo -->

<!-- FooTable -->
<script src="<?php echo assets_url('js/plugins/footable/footable.all.min.js');?>"></script>

<!-- Page-Level Scripts -->
<script src="<?php echo assets_url(); ?>script/twitter_view.js"></script>
