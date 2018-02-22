$(document).ready(function(){
	// Capturamos la base_url
    var base_url = $("#base_url").val();
	
	var tabEntradas = $('#tab_observaciones').DataTable({
        //~ "paging": true,
        //~ "lengthChange": false,
        "autoWidth": false,
        //~ "searching": true,
        //~ "ordering": true,
        //~ "info": true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
			"method":"POST",
			"url": base_url+"observaciones_json"
		},
		"columnDefs": [
			{
				//~ "target": [0, 3, 4],
				"orderable":false,
			}
		],
        //~ "iDisplayLength": 50,
        //~ "iDisplayStart": 0,
        //~ "sPaginationType": "full_numbers",
        //~ "aLengthMenu": [50, 100, 150],
        "oLanguage": {"sUrl": base_url+"assets/js/es.txt"},
        "aoColumns": [
            {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sClass": "registro center", "sWidth": "20%"},
            {"sClass": "registro center", "sWidth": "20%"},
            {"sClass": "registro center", "sWidth": "10%"},
            {"sWidth": "9%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "3%", "sClass": "registro center"},
            {"sWidth": "3%", "sClass": "registro center"}
        ]
    });
    
	// Función para cambiar un twitter a otra bandeja según la opción seleccionada en su respectivo combo
	$("table#tab_observaciones").on('change', 'select.cambiar', function (e) {
		
		e.preventDefault();
		
		var id = this.getAttribute('id');
		id = id.split(";");
		id = id[0];  // Id de la cola
		var estatus_actual = this.getAttribute('id');
		estatus_actual = estatus_actual.split(";");
		estatus_actual = estatus_actual[1];  // Estatus actual de la cola
		var select_actual = $(this);  // Combo actualmente seleccionado
		var nueva_bandeja = $(this).val();  // Bandeja nueva para el tweet
		
		//~ alert("Id: "+id+" | Nueva bandeja: "+nueva_bandeja);
		
		swal({
            title: "Cambiar de bandeja",
            text: "¿Está seguro de asignar el tweet a otra bandeja?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Asignar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
             
                $("#modal_detalles").modal('show');
                $("#id_tweet").val(id);
                $("#nueva_bandeja").val(nueva_bandeja);
                
            }else{
				
				// Si cancelamos el cambio de estatus, fijamos el select al estatus inicial
				select_actual.val('0');
			
			} 
        });
		
	});
	
	// Función para cambiar un twitter a otra bandeja según la opción seleccionada en su respectivo combo
	$("#asignar").on('click', function (e) {
		
		if($("#detalles").val().trim() == ''){
			
			swal("Disculpe,", "debe indicar los detalles de la asignación");
			$("#detalles").focus();
			
		}else{
			
			$.post(base_url+'observaciones/cambiar_bandeja', {'id':$("#id_tweet").val(), 'nueva_bandeja':$("#nueva_bandeja").val(), 'mensaje':$("#detalles").val()}, function (response) {

				if (response['response'] == "error") {
				   
					swal({
						title: "Disculpe,",
						text: "Ha ocurrido un error durante la asignación, por favor contacte con su administrador.",
						type: "warning" 
					},
					function(){
						// Si hay algún error, fijamos el select al estatus inicial
						select_actual.val('0');
					});
					
				}else{
					 swal({ 
					   title: "Asignación a nueva bandeja",
						text: "Asignación realizada con éxito",
						 type: "success" 
					   },
					   function(){
						 window.location.href = base_url+'bandeja_observaciones';
					 });
				}
			}, 'json');
		
		}		
		
	});
	
	// Función para cambiar un twitter a otra bandeja según la opción seleccionada en su respectivo combo
	$("table#tab_observaciones").on('click', 'a.eliminar', function (e) {
		
		e.preventDefault();
		
		var id = this.getAttribute('id');
		id = id.split(";");
		id = id[0];  // Id de la cola
		var estatus_actual = this.getAttribute('id');
		estatus_actual = estatus_actual.split(";");
		estatus_actual = estatus_actual[1];  // Estatus actual de la cola
		
		//~ alert("Id: "+id);
		
		swal({
            title: "Eliminar observación",
            text: "¿Está seguro de eliminar la observación?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm){
			
            if (isConfirm) {
             
                $.post(base_url+'observaciones/eliminar', {'id':id}, function (response) {
					
					if (response['response'] == "error") {
				   
						swal({
							title: "Disculpe,",
							text: "Ha ocurrido un error durante la eliminación, por favor contacte con su administrador.",
							type: "warning" 
						},
						function(){
							// Si hay algún error, fijamos el select al estatus inicial
							//~ select_actual.val('0');
						});
						
					}else{
						 swal({ 
						   title: "Eliminación completada",
							text: "Observación eliminada con éxito",
							 type: "success" 
						   },
						   function(){
							 window.location.href = base_url+'bandeja_observaciones';
						 });
					}
					
				});
                
            }
            
        });
		
	});
	
	// Función para ver el time-line de un twitter tomando en cuenta el valor del id
	$("table#tab_observaciones").on('click', 'a.verId', function (e) {
		
		var valor = this.innerHTML;
		
		$("#id_str").val(valor);
		$("#screen_name").val('');
		
		window.location.href = base_url+'time_line/time_line?id_str='+$("#id_str").val()+'&ruta='+$("#ruta_origen").val();
		
	});
    
	// Función para ver los datos de un twitter tomando en cuenta el valor del screen_name
	$("table#tab_observaciones").on('click', 'a.verName', function (e) {
		
		var valor = this.innerHTML;
		
		$("#id_str").val('');
		$("#screen_name").val(valor);
		
		window.location.href = base_url+'twitters/view?screen_name='+$("#screen_name").val()+'&ruta='+$("#ruta_origen").val();
		
	});
	
	// Función para ver el time-line de un twitter tomando en cuenta el valor del id
	$("table#tab_observaciones").on('click', 'a.verText', function (e) {
		
		var valor = this.getAttribute('id');
		
		$("#id_str").val(valor);
		$("#screen_name").val('');
		
		window.location.href = base_url+'time_line/time_line?id_str='+$("#id_str").val()+'&ruta='+$("#ruta_origen").val();
		
	});
	
	
	// FUNCIONES DE BORRADO MÚLTIPLE
	
	// Función para marcar/desmarcar todos los inputs
	$("table#tab_observaciones").on('change', 'input#check_all', function (e) {
		e.preventDefault();
		
		var check = $(this);
		
		var accion = '';
		if (check.is(':checked')) {
            accion = 'marcar';
            check.prop("checked", "checked");  // Marcamos nuevamente el checkbox
            // Recorremos la tabla marcando todos los checkbox
            $("#tab_observaciones tbody tr").each(function () {
				$(this).find('td').find('input').prop("checked", "checked");
			});
        }else{
			accion = 'desmarcar';
			check.prop("checked", "");  // Desmarcamos nuevamente el checkbox
			// Recorremos la tabla desmarcando todos los checkbox
            $("#tab_observaciones tbody tr").each(function () {
				$(this).find('td').find('input').prop("checked", "");
			});
		}
	});
	
	// Función para marcar/desmarcar un input seleccionado
	$("table#tab_observaciones").on('change', 'input.check', function (e) {
		e.preventDefault();
        var id = this.getAttribute('id');
		
        var check = $(this);
		
		var accion = '';
		if (check.is(':checked')) {
            accion = 'marcar';
            check.prop("checked", "checked");  // Marcamos nuevamente el checkbox
        }else{
			accion = 'desmarcar';
			//~ alert(accion);
			check.prop("checked", "");  // Desmarcamos nuevamente el checkbox
		}
	});
	
	// Proceso de borrado de observaciones seleccionadas
	$("#borrar_seleccion").on('click', function (e) {
		var num_checked = 0;  // Contador de checkbox marcados
		
		// Recorremos la tabla para contar los registros marcados
		$("#tab_observaciones tbody tr").each(function () {
			var checkbox;
			checkbox = $(this).find('td').eq(0).find('input');
			
			if (checkbox.is(':checked')) {
				num_checked += 1;
			}
		});
		
		if (num_checked == 0) {
			swal("Disculpe,", "no ha marcado ningún elemento de la lista");
			$('#resultado').css({display:'none'});
			$('#agregar').prop('disabled',false);
			$('#referenciar').prop('disabled',false);
		}else{
		
			swal({
				title: "Eliminar observaciones",
				text: "¿Está seguro de borrar las observaciones seleccionadas?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Borrar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false,
				closeOnCancel: true
			  },
			function(isConfirm){
				if (isConfirm) {
					
					var data = [];  // Arreglo para ids de observaciones a borrar
					// Recorremos la tabla para verificar qué registros están marcados y proceder a incluirlos en el arreglo
					$("#tab_observaciones tbody tr").each(function () {
						var checkbox;
						checkbox = $(this).find('td').eq(0).find('input');
						
						if (checkbox.is(':checked')) {
							var id = $(this).find('a.eliminar').attr('id');
							id = id.split(';');
							id = id[0];
							
							data.push(id);
						}
					});
					
					console.log(data);
					
					$.ajax({
						url : base_url+'CBandejaObservaciones/eliminar_multi',
						type : 'POST',
						async: false,  // Para que no proceda con las siguientes instrucciones hasta terminar la petición
						//~ dataType : 'json',
						data : {'observaciones': data},
						beforeSend:function(objeto){
							$('#borrar_todo').prop('disabled',true);
							$('#borrar_seleccion').prop('disabled',true);
						},
						success : function(response) {
							
							$('#resultado').css({display:'none'});
							$('#agregar').prop('disabled',false);
							$('#referenciar').prop('disabled',false);
							swal({
								title: "Borrado",
								 text: "Borrado con exito",
								  type: "success" 
								},
							function(){
								// Reiniciamos
								window.location.href = base_url+'bandeja_observaciones';
							});
															
						},
					});
					
				}
			});  // Cierre del confirm
			
		}  // Cierre del if que valida si hay checkbox marcados
		
	});
	
	// Borrado general de observaciones
	$("#borrar_todo").on('click', function (e) {
		swal({
			title: "Eliminar observaciones",
			text: "¿Está seguro de borrar todas las observaciones?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Borrar",
			cancelButtonText: "Cancelar",
			closeOnConfirm: false,
			closeOnCancel: true
		  },
		function(isConfirm){
			if (isConfirm) {
				
				var data = [];  // Arreglo para ids de observaciones a borrar
				// Recorremos la tabla para verificar qué registros están marcados y proceder a incluirlos en el arreglo
				$("#tab_observaciones tbody tr").each(function () {
					var checkbox;
					checkbox = $(this).find('td').eq(0).find('input');
					
					var id = $(this).find('a.eliminar').attr('id');
					id = id.split(';');
					id = id[0];
					
					data.push(id);
				});
				
				console.log(data);
				
				$.ajax({
					url : base_url+'CBandejaObservaciones/eliminar_multi',
					type : 'POST',
					async: false,  // Para que no proceda con las siguientes instrucciones hasta terminar la petición
					//~ dataType : 'json',
					data : {'observaciones': data},
					beforeSend:function(objeto){
						$('#borrar_todo').prop('disabled',true);
						$('#borrar_seleccion').prop('disabled',true);
					},
					success : function(response) {
						
						$('#resultado').css({display:'none'});
						$('#agregar').prop('disabled',false);
						$('#referenciar').prop('disabled',false);
						swal({
							title: "Borrado",
							 text: "Borrado con exito",
							  type: "success" 
							},
						function(){
							// Reiniciamos
							window.location.href = base_url+'bandeja_observaciones';
						});
														
					},
				});
				
			}
			
		});  // Cierre del confirm
		
	});
	
});
