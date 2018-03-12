<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//~ $datos_sesion = array();
?><!DOCTYPE html>
<html lang="en">
<head>
		 <!-- Metadata -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Puesto de comando Aragua</title>
	<!-- CSS Files -->
    <link href="<?php echo assets_url('css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo assets_url('font-awesome/css/font-awesome.css');?>" rel="stylesheet">
	<link href="<?php echo assets_url('css/plugins/iCheck/custom.css');?>" rel="stylesheet">
    <link href="<?php echo assets_url('css/plugins/steps/jquery.steps.css');?>" rel="stylesheet">
	<link href="<?php echo assets_url('css/plugins/dataTables/datatables.min.css');?>" rel="stylesheet">
	<link href="<?php echo assets_url('css/plugins/select2/select2.min.css');?>" rel="stylesheet">
	<link href="<?php echo assets_url('js/datatables.net-bs/css/dataTables.bootstrap.css'); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo assets_url('css/dataTables.responsive.css'); ?>">
    <link href="<?php echo assets_url('js/datatables.net-responsive-bs/css/responsive.bootstrap.min.css'); ?>"
	<link href="<?php echo assets_url('css/animate.css');?>" rel="stylesheet">
    <link href="<?php echo assets_url('css/style.css');?>" rel="stylesheet">
	<link href="<?php echo assets_url('css/plugins/datapicker/datepicker3.css');?>" rel="stylesheet">
	 <!-- Sweet Alert -->
    <link href="<?php echo assets_url('css/plugins/sweetalert/sweetalert.css');?>" rel="stylesheet">
    <!-- Highcharts css -->
    <link href="<?php echo assets_url('css/Highcharts/highcharts.css');?>" rel="stylesheet">
    <link href="<?php echo assets_url('css/bootstrap-tagsinput.css');?>" rel="stylesheet">
    <link href="<?php echo assets_url('css/bootstrap-tokenfield.min.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style type="text/css">
		ul.ui-autocomplete {
		     z-index: 99999 !important;
		}
    </style>
	
	<!-- Custom and plugin javascript -->
	<!--<script src="<?php echo assets_url('js/jquery-3.1.1.min.js');?>"></script>-->
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script src="<?php echo assets_url('js/bootstrap.min.js');?>"></script>
	<script src="<?php echo assets_url('js/plugins/metisMenu/jquery.metisMenu.js');?>"></script>
	<script src="<?php echo assets_url('js/plugins/slimscroll/jquery.slimscroll.min.js');?>"></script>
	<script src="<?php echo assets_url('js/plugins/dataTables/datatables.min.js');?>"></script>
	<script src="<?php echo assets_url('js/plugins/select2/select2.full.min.js');?>"></script>
	<script src="<?php echo assets_url('js/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo assets_url('js/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
	<script src="<?php echo assets_url('js/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>"></script>
	<script src="<?php echo assets_url('js/inspinia.js');?>"></script>
	<script src="<?php echo assets_url('js/bootstrap-tagsinput.js');?>"></script>
	<script src="<?php echo assets_url('js/plugins/pace/pace.min.js');?>"></script>
	<script src="<?php echo assets_url('js/plugins/slimscroll/jquery.slimscroll.min.js');?>"></script>
	 <!-- Sweet alert -->
    <script src="<?php echo assets_url('js/plugins/sweetalert/sweetalert.min.js');?>"></script>
	   <!-- Custom and plugin javascript -->
    <script src="<?php echo assets_url('js/inspinia.js');?>"></script>
    <script src="<?php echo assets_url('js/plugins/pace/pace.min.js');?>"></script>
    <!-- Steps -->
    <script src="<?php echo assets_url('js/plugins/steps/jquery.steps.min.js');?>"></script>
	    <!-- Jquery Validate -->
    <script src="<?php echo assets_url('js/plugins/validate/jquery.validate.min.js');?>"></script>
	<script src="<?php echo assets_url('js/jquery.numeric.js');?>"></script>
		<!-- Data picker -->
   <script src="<?php echo assets_url('js/plugins/datapicker/bootstrap-datepicker.js');?>"></script>
   <!-- Date range picker -->
    <script src="<?php echo assets_url('js/plugins/daterangepicker/daterangepicker.js');?>"></script>
		<!-- Typehead -->
    <!--<script src="<?php echo assets_url('js/plugins/typehead/bootstrap3-typeahead.min.js');?>"></script>-->
    <script src="<?php echo assets_url('js/typeahead.bundle.js');?>"></script>
    <script src="<?php echo assets_url('js/jquery.caret.js');?>"></script>
    <!-- Highcharts js -->
    <script src="<?php echo assets_url('js/Highcharts/highcharts.js');?>"></script>
    <script src="<?php echo assets_url('js/Highcharts/highcharts-3d.js');?>"></script>
    <script src="<?php echo assets_url('js/Highcharts/exporting.js');?>"></script>
    
</head>
<body class="md-skin fixed-nav no-skin-config">
	<div id="wrapper">
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element">
							<!--<span>
								<img alt="image" class="img-circle" src="<?php echo assets_url('img/profile_small.jpg'); ?>" />
							</span>-->
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear">
									<span class="block m-t-xs">
										<strong class="font-bold"><?php echo $this->session->userdata('logged_in')['username'];?></strong>
									</span>
									<span class="text-muted text-xs block"><?php echo $this->session->userdata('logged_in')['profile_name'];?>
										<b class="caret"></b>
									</span>
								</span>
							</a>
							<ul class="dropdown-menu animated fadeInRight m-t-xs">
								<li><a href="<?php echo base_url();?>home">Inicio</a></li>
								<li><a class="change_users">Cambiar contraseña</a></li>
								<!--<li><a href="">Perfil</a></li>-->
								<!--<li><a href="contacts.html">Contactos</a></li>-->
								<li class="divider"></li>
								<li><a href="<?php echo base_url();?>logout">Cerrar Sesión</a></li>
							</ul>
						</div>
						<div class="logo-element">
							IN+
						</div>
					</li>
					
					<!-- Carga de menú lateral -->
					<?php echo menu(); ?>
					<!-- Carga de menú lateral -->

				</ul>

			</div>
		</nav>

		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
						<!--<form role="search" class="navbar-form-custom" action="search_results.html">
							<div class="form-group">
								<input type="text" placeholder="Buscar..." class="form-control" name="top-search" id="top-search">
							</div>
						</form>-->
					</div>
					<ul class="nav navbar-top-links navbar-right">
						<li>
							<span class="m-r-sm text-muted welcome-message">Bienvenido a Puesto de comando Aragua.</span>
						</li>
						<!--<li class="dropdown">
							<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
								<i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
							</a>
							<ul class="dropdown-menu dropdown-messages">
								<li>
									<div class="dropdown-messages-box">
										<a href="profile.html" class="pull-left">
											<img alt="image" class="img-circle" src="<?php echo assets_url('img/a7.jpg'); ?>">
										</a>
										<div class="media-body">
											<small class="pull-right">46h ago</small>
											<strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
											<small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="dropdown-messages-box">
										<a href="profile.html" class="pull-left">
											<img alt="image" class="img-circle" src="<?php echo assets_url('img/a4.jpg'); ?>">
										</a>
										<div class="media-body ">
											<small class="pull-right text-navy">5h ago</small>
											<strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
											<small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="dropdown-messages-box">
										<a href="profile.html" class="pull-left">
											<img alt="image" class="img-circle" src="<?php echo assets_url('img/profile.jpg');?>">
										</a>
										<div class="media-body ">
											<small class="pull-right">23h ago</small>
											<strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
											<small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="text-center link-block">
										<a href="mailbox.html">
											<i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
										</a>
									</div>
								</li>
							</ul>
						</li>-->
						
						<li class="dropdown" id="li_respuestas" style="display:none;">
							<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
								<i class="fa fa-bell"></i> <span class="label label-warning" id="span_num_respuestas"></span>
							</a>
							<ul class="dropdown-menu dropdown-alerts">
								<li>
									<a href="<?php echo base_url(); ?>bandeja_respuestas">
										<div>
											<i class="fa fa-envelope fa-fw"></i> <span id="span_num_respuestas_text"></span>
											<!--<span class="pull-right text-muted small">4 minutes ago</span>-->
										</div>
									</a>
								</li>
								<!--<li class="divider"></li>
								<li>
									<a href="profile.html">
										<div>
											<i class="fa fa-twitter fa-fw"></i> 3 New Followers
											<span class="pull-right text-muted small">12 minutes ago</span>
										</div>
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="grid_options.html">
										<div>
											<i class="fa fa-upload fa-fw"></i> Server Rebooted
											<span class="pull-right text-muted small">4 minutes ago</span>
										</div>
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<div class="text-center link-block">
										<a href="notifications.html">
											<strong>See All Alerts</strong>
											<i class="fa fa-angle-right"></i>
										</a>
									</div>
								</li>-->
							</ul>
						</li>
			
			
						<li>
							<a href="<?php echo base_url();?>logout">
								<i class="fa fa-sign-out"></i> Cerrar Sesión
							</a>
						</li>
					</ul>
			
				</nav>
			</div>
			
			<input type="hidden" value="<?php echo $this->session->userdata('logged_in')['group']; ?>" id="group_id">

			<div class="modal fade" id="div_cambio_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	            <div class="modal-dialog" role="document">
	                <div class="modal-content">
	                    <div class="modal-body">
	                        <form method="post" enctype="multipart/form-data" id="frmpassword">
	                            <div class="col-xs-12">
	                                <div class="form-group col-xs-6" style="margin:auto;">
	                                    <label>Contraseña anterior</label>
	                                    <input style="text-transform: lowercase;" type="password" id='password_f' name='password_f' class="form-control" placeholder="Contraseña anterior" autofocus='autofocus'/>
	                                </div>
	                                <div class="form-group col-xs-6" style="margin:auto;">
	                                    <label>Contraseña nueva</label>
	                                    <input style="text-transform: lowercase;" type="password" id='password_new' name='password' class="form-control" placeholder="Contraseña nueva"/>
	                                </div>
	                            </div>
	                            <div class="col-xs-12">
	                                <div class="form-group col-xs-12">
	                                    <label>Ingrese de nuevo la contraseña</label>
	                                    <input style="text-transform: lowercase;" type="password" id='password_new_r' class="form-control" placeholder="Repita su contraseña"/>
	                                    <input type="hidden" name='id' value="<?php echo $this->session->userdata['logged_in']['id']; ?>"/>
	                                </div>
	                            </div>
	                        </form>
	                    </div>
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-success actualizar_passwd">Cambiar</button>
	                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
	                    </div>
	                </div>
	            </div>
	        </div>
			
			<script>
				$(document).ready(function () {

					$("a.change_users").click(function () {
						$('div#div_cambio_user').modal({backdrop: 'static', keyboard: false});
					});

					$(".actualizar_passwd").click(function () {
		                var $password = $("#password_f");
		                var $password_new = $("#password_new");
		                var $password_new_r = $("#password_new_r");

		                if ($password.val() == "") {
		                    swal("Disculpe,", "debe ingresar su contraseña anterior");
		                    $password.focus();

		                } else if ($password_new.val() == "") {
		                    swal("Disculpe,", "debe ingresar su contraseña nueva");
		                    $password_new.focus();

		                } else if ($password_new_r.val() == "") {
		                 	swal("Disculpe,", "ingrese de nuevo su contraseña");
		                    $password_new_r.focus();

		                 } else if ($password_new.val() != $password_new_r.val()) {
		                    swal("Disculpe,", "las contraseñas no coinciden");
		                    $password_new_r.focus();

		                } else {
		                	swal({
					            title: "¿Está seguro de cambiar su contraseña?",
					            text: "Asegurece de que su contraseña este formulada correctamente",
					            type: "warning",
					            showCancelButton: true,
					            confirmButtonColor: "#DD6B55",
					            confirmButtonText: "Aceptar",
					            cancelButtonText: "Cancelar",
					            closeOnConfirm: false,
					            closeOnCancel: true
					          },
					          function(isConfirm){
				                if (isConfirm) {
				                  $.post('<?php echo base_url(); ?>CUser/change_users',$("#frmpassword").serialize(), function (response) {
				                                  if (response == 1) {
				                                      swal("Registro actualizado correctamente...");
				                                      location.reload();
				                                  }else if (response == 2) {
				                                      swal("Disculpe,", "las contraseñas anteriores no es correcta");
				                                  }
				                              });
				                } else {
				                  swal("Rectificar","Puede rectificar sus datos nuevamente!");
				                }
					          });

		                }
		            });

					window.globalVar;

					var base_url = function(path) {
				        var protocolo = location.protocol;
				        var base = window.location.host;

				        // var ur = base.replace(/(.*)\.(.*?)$/, "$1");
				        var url  = base;
				        if(path !== undefined){
				            url = url+path;
				        }
				        url = protocolo+'//'+url
				        return url;
				    };
				
				    function datos()
					{
					    return $.ajax({
					        url: '<?php echo base_url("/situacion_mensiones_json"); ?>',
					        method: 'POST',
					        async: false,
				        });
					}

					$.when( datos() ).done(function(response){
						globalVar = response;
						globalVar = $.parseJSON(globalVar);
						//console.log(globalVar);
					});

					//initialization
					function init(){
					    var autoSuggestion = document.getElementsByClassName('ui-autocomplete');
					    if(autoSuggestion.length > 0){
					        autoSuggestion[0].style.zIndex = 1051;
					    }
					}

					$( function() {
						
						function split( val ) {
							return val.split( / \s*/ );
						}
						function extractLast( term ) {
							return split( term ).pop();
						}

						$( "#detalles" )
							// don't navigate away from the field on tab when selecting an item
							.on( "keydown", function( event ) {
								if ( event.keyCode === $.ui.keyCode.TAB &&
										$( this ).autocomplete( "instance" ).menu.active ) {
									event.preventDefault();
								}
							})
							.autocomplete({
								minLength: 0,
								 appendTo: $("#modal_detalles"),
								source: function( request, response ) {
									// delegate back to autocomplete, but extract the last term
									response( $.ui.autocomplete.filter(
										globalVar, extractLast( request.term ) ) );
								},
								focus: function() {
									// prevent value inserted on focus
									return false;
								},
								select: function( event, ui ) {
									var terms = split( this.value );
									// remove the current input
									terms.pop();
									// add the selected item
									terms.push( ui.item.value );
									// add placeholder to get the comma-and-space at the end
									terms.push( "" );
									this.value = terms.join( " " );
									return false;
								}
							});
					} );

					/* Evento para cuando el usuario libera la tecla escrita dentro del input */
					$('#detalles').change(function(){
					    /* Obtengo el valor contenido dentro del input */
					    var value = $(this).val();
					 
					    /* Elimino todos los espacios en blanco que tenga la cadena delante y detrás */
					    var value_without_space = $.trim(value);
					 
					    /* Muestro una alerta al usuario */
					    //alert('El texto que ha ingresado contiene espacios y serán eliminados');
					 
					    /* Cambio el valor contenido por el valor sin espacios */
					    $(this).val(value_without_space);
					});

					

					//var myTypeahead = new MyTypeahead('#textarea', datos_json, {levenshteinDistance: 3, vertAdjustMenu: true, trigger: '@'});

					// Aplicamos select2() a todos los combos select
					$("select").select2();
					
					$('.datepicker').datepicker({
				        format: "dd-mm-yyyy",
				        language: "es",
				        autoclose: true,
				    });

					// Función añadida manualmente para alternar entre mini-barra y barra de menú completa u ocultar en dispositivos móviles
					// .navbar-minimalize = clase del botón de acción
					// .md-skin = clase de la etiqueta body asignada automáticamente por los plugins de la plantilla
					$(".navbar-minimalize").on('click', function(){
						var cadena1 = "md-skin fixed-nav no-skin-config pace-done pace-done";
						var cadena1_small = "md-skin fixed-nav no-skin-config body-small pace-done pace-done";
						var cadena2 = "md-skin fixed-nav no-skin-config pace-done pace-done mini-navbar";
						var cadena2_small = "md-skin fixed-nav no-skin-config body-small pace-done pace-done mini-navbar";
						if($(".md-skin").attr("class") == cadena1 || $(".md-skin").attr("class") == cadena1_small){
							$(".md-skin").addClass("mini-navbar");
						}else if($(".md-skin").attr("class") == cadena2 || $(".md-skin").attr("class") == cadena2_small){
							$(".md-skin").removeClass("mini-navbar");
						}
					});
				});
				
				// Ajax para contar la cantidad de respuestas pendientes del usuario logueado si éste pertenece a un grupo de bandejas
				//~ if($("#group_id").val() != "0"){
					
					$.post('<?php echo base_url(); ?>CBandejaRespuestas/respuestas_pendientes', function (response) {
						
						$("#span_num_respuestas").text(response['recordsTotal']);
						$("#span_num_respuestas_text").text('Tienes '+response['recordsTotal']+' respuesta(s) pendiente(s)');
						
						if(parseInt(response['recordsTotal']) > 0){
							$("#span_num_respuestas").removeClass('label-primary');
							$("#span_num_respuestas").addClass('label-warning');
						}else{
							$("#span_num_respuestas").removeClass('label-warning');
							$("#span_num_respuestas").addClass('label-primary');
						}
						
					}, 'json');
					
					$("#li_respuestas").show();
					
				//~ }
				
			</script>
		<!-- Validación de acciones -->
		<?php echo validar_acciones(); ?>
		<!-- Validación de acciones -->		
