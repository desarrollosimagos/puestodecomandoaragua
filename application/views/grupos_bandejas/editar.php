<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Grupo de Bandeja </h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url() ?>home">Inicio</a>
            </li>
            
            <li>
                <a href="<?php echo base_url() ?>services">Grupo de Bandeja</a>
            </li>
           
            <li class="active">
                <strong>Editar Grupo de Bandeja</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
        <div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Editar Grupo de Bandeja <small></small></h5>
				</div>
				<div class="ibox-content">
					<form id="form_grupos_bandejas" method="post" accept-charset="utf-8" class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label" >Nombre *</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="nombre" id="nombre" maxlength="150" value="<?php echo $editar[0]->nombre ?>">
							</div>
						</div>
						<div class="form-group"><label class="col-sm-2 control-label" >Perfiles</label>
							<div class="col-sm-10">
								<select id="perfiles_ids" class="form-control" multiple="multiple">
									<?php
									foreach ($perfiles as $perfil) {
										?>
										<option value="<?php echo $perfil->id; ?>"><?php echo $perfil->name; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" >Estatus *</label>
							<div class="col-sm-10">
								<select class="form-control m-b" name="status" id="status">
									<option value="1">Activo</option>
									<option value="0">Inactivo</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4 col-sm-offset-2">
								 <input id="id_status" type="hidden" value="<?php echo $editar[0]->status ?>"/>
								 <input id="ids_perfiles" type="hidden" value="<?php echo $ids_perfiles; ?>"/>
								 <input class="form-control"  type='hidden' id="id" name="id" value="<?php echo $id ?>"/>
								<button class="btn btn-white" id="volver" type="button">Volver</button>
								<button class="btn btn-primary" id="edit" type="submit">Guardar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

    $('input').on({
        keypress: function () {
            $(this).parent('div').removeClass('has-error');
        }
    });

    $('#volver').click(function () {
        url = '<?php echo base_url() ?>grupos_bandejas/';
        window.location = url;
    });
	
	$("#status").val($("#id_status").val());
	
	// Fijamos los perfiles asociados
	var perfiles_ids = $("#ids_perfiles").val();
	perfiles_ids = perfiles_ids.split(",");
	$("#perfiles_ids").select2('val', perfiles_ids);

    $("#edit").click(function (e) {

        e.preventDefault();  // Para evitar que se envíe por defecto

        if ($('#nombre').val().trim() === "") {
			swal("Disculpe,", "para continuar debe ingresar nombre");
			$('#nombre').parent('div').addClass('has-error');
			
        } else {

            $.post('<?php echo base_url(); ?>CGruposBandejas/update', $('#form_grupos_bandejas').serialize()+'&'+$.param({'perfiles_ids':$('#perfiles_ids').val()}), function (response) {

				if (response[0] == '1') {
                    swal("Disculpe,", "este grupo se encuentra registrado");
                }else{
					swal({ 
						title: "Actualizar",
						 text: "Guardado con exito",
						  type: "success" 
						},
					function(){
					  window.location.href = '<?php echo base_url(); ?>grupos_bandejas';
					});
				

				}

            });
            
            /*var formData = new FormData(document.getElementById("form_services"));  // Forma de capturar todos los datos del formulario
			
			$.ajax({
				//~ method: "POST",
				type: "post",
				dataType: "html",
				url: '<?php echo base_url(); ?>CServices/update',
				data: formData,
				cache: false,
				contentType: false,
				processData: false
			})
			.done(function(data) {
				if(data.error){
					console.log(data.error);
				} else {
					if (data[0] == '1') {
						swal("Disculpe,", "este servicio se encuentra registrado");
					}else{
						swal({ 
							title: "Registro",
							 text: "Guardado con exito",
							  type: "success" 
							},
						function(){
						  window.location.href = '<?php echo base_url(); ?>services';
						});
					}
				}				
			}).fail(function() {
				console.log("error ajax");
			});*/
        }
    });
});

</script>
