<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Situación </h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>home">Inicio</a>
            </li>
            <li>
                <a href="<?php echo base_url() ?>situacion">Situación</a>
            </li>
            <li class="active">
                <strong>Registrar Usuarios</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
        <div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Registrar Situación <small></small></h5>
				</div>
				<div class="ibox-content">
					<form id="form_situacion" method="post" accept-charset="utf-8" class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label" >Situación</label>
							<div class="col-sm-10">
								<input type="text" class="form-control"  placeholder="" name="name" id="name">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" >Descripción *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control"  placeholder="" name="description" id="description">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								<button class="btn btn-white" id="volver" type="button">Volver</button>
								<button data-accion='add' data-name='Registro' class="btn btn-primary" id="registrar" type="submit">Guardar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
 <script src="<?php echo assets_url('script/situacion.js'); ?>" type="text/javascript" charset="utf-8" ></script>
