$(document).ready(function() {
	// Capturamos la base_url

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
    
    var table = $('#tab_situacion').DataTable({
       "paging": true,
       "lengthChange": false,
       "autoWidth": false,
       "searching": true,
       "ordering": true,
       "info": true,
       dom: '<"html5buttons"B>lTfgitp',
       buttons: [
           { extend: 'copy'},
           {extend: 'csv'},
           {extend: 'excel', title: 'ExampleFile'},
           {extend: 'pdf', title: 'ExampleFile'},

           {extend: 'print',
            customize: function (win){
                   $(win.document.body).addClass('white-bg');
                   $(win.document.body).css('font-size', '10px');

                   $(win.document.body).find('table')
                           .addClass('compact')
                           .css('font-size', 'inherit');
           }
           }
       ],
       "iDisplayLength": 5,
       "iDisplayStart": 0,
       "sPaginationType": "full_numbers",
       "aLengthMenu": [5, 10, 15],
       "oLanguage": {"sUrl": base_url("/assets/js/es.txt")},
       "aoColumns": [
           {"sClass": "registro center", "sWidth": "5%"},
           {"sClass": "registro center", "sWidth": "10%"},
           {"sClass": "registro center", "sWidth": "10%"},
           {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
           {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
       ]       
    });
        
    $('input').on({
        keypress: function () {
            $(this).parent('div').removeClass('has-error');
        }
    });

    $('#volver2').click(function () {
        url = '../situacion/';
        window.location = url;
    });
    
    $('#volver').click(function () {
        url = base_url('/situacion');
        window.location = url;
    });

    $("#registrar").click(function (e) {

        e.preventDefault();  // Para evitar que se envíe por defecto
        // Expresion regular para validar el correo
		var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		var accion = $(this).data('accion');
		var title = $(this).data('name');

        if ($('#name').val().trim() === "") {
		   swal("Disculpe,", "para continuar debe ingresar nombre");
	       $('#name').parent('div').addClass('has-error');
        } else if ($('#description').val().trim() === "") {
          
		   swal("Disculpe,", "para continuar debe ingresar la descripción");
	       $('#description').parent('div').addClass('has-error');
		   
        } else {

            $.post(base_url('/CSituacion/'+accion), $('#form_situacion').serialize(), function (response) {

				if (response == 'existe') {
                    swal("Disculpe,", "este nombre ya se encuentra registrado");
                }else{
					swal({ 
						title: title,
						 text: "Guardado con exito",
						  type: "success" 
						},
					function(){
					  window.location.href = base_url('/situacion');
					});
				}

            });
        }

    });

    // Validacion para borrar
    table.on('click', 'a.borrar', function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        swal({
            title: "Borrar registro",
            text: "¿Está seguro de borrar el registro?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            closeOnCancel: true
          },
          function(isConfirm){
            if (isConfirm) {
             
              $.post(base_url('/CSituacion/delete/'+id), function (response) {

                 //~ if (response[0] == "e") {
                    //~ 
                      //~ swal({ 
                        //~ title: "Disculpe,",
                         //~ text: "No se puede eliminar se encuentra asociado a un submenú",
                          //~ type: "warning" 
                        //~ },
                        //~ function(){
                          //~ 
                      //~ });
                 //~ }else{
                      swal({
                        title: "Eliminar",
                         text: "Registro eliminado con exito",
                          type: "success" 
                        },
                        function(){
                          window.location.href = base_url('/situacion');
                      });
                    
                 //~ }
            
   
             });
            } 
          });
    	});
    
});
