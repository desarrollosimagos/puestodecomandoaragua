<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Situación</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>home">Inicio</a>
            </li>
            <li class="active">
                <strong>Situación</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo base_url() ?>situacion_register">
            <button class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-plus"></i> Agregar</button></a>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Listado de Situación </h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tab_situacion" class="table table-striped table-bordered dt-responsive table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($listar as $row) { ?>
                                    <tr style="text-align: center">
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo "#".$row->name; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->description; ?>
                                        </td>
                                        <td style='text-align: center'>
                                            <a href="<?php echo base_url() ?>situacion_edit/<?= $row->id; ?>"  title="Editar" style='color: #1ab394'><i class="fa fa-edit fa-2x"></i></a>
                                        </td>
                                        <td style='text-align: center'>
											<a class="borrar" data-id='<?php echo $row->id?>' href="<?php echo base_url() ?>situacion_delete/<?= $row->id; ?>"  title="Editar" style='color: #1ab394'><i class="fa fa-edit fa-2x"></i></a>
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
</div>
<script src="<?php echo assets_url('script/situacion.js'); ?>" type="text/javascript" charset="utf-8" ></script>

