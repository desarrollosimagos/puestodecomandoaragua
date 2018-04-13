<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Twitters</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>home">Inicio</a>
            </li>
            <li class="active">
                <strong>Twitters</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Twitters </h5>
                    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tab_twitters" class="table table-striped table-bordered dt-responsive table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Solicitante</th>
                                    <th>Nombre</th>
                                    <th>URL</th>
                                    <th>Seguidores</th>
                                    <th>Amigos</th>
                                    <th>Favoritos</th>
                                    <th>Imagen</th>
                                </tr>
                            </thead>
							
                        </table>
                        <!-- Campos ocultos de id y nombre del twitter -->
                        <input type="hidden" id="id">
						<input type="hidden" id="screen_name">
						<input type="hidden" id="ruta_origen" value="twitters">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Page-Level Scripts -->
<script src="<?php echo assets_url(); ?>script/twitters.js"></script>
