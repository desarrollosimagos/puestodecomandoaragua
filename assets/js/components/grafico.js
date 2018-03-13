$(document).ready(function () {

    $('.numeric').numeric();

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

    // Grafico por operador
    function grafico_operador(desde, hasta){
        $.post(base_url('/operador_json?desde='+desde+'&hasta='+hasta), function(data, status){
                
            var datos = $.parseJSON(data);

            $("h2.count-opr").text(datos.cantidad.cantidad);
            $('#container-operador').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: ''
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
                            }
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Indicador',
                    colorByPoint: true,
                    data: datos.grafico
                }]
            });
                    
        });
    }

    grafico_operador(0, 0);

    $('#desde-operador, #hasta-operador').change(function(){
        var desde_operador = $("#desde-operador").val();
        var hasta_operador = $("#hasta-operador").val();

        if(desde_operador ==0 && hasta_operador ==0){
            grafico_operador(0, 0);
        }else if(desde_operador !=0 && hasta_operador !=0){
            grafico_operador(desde_operador, hasta_operador);
        }
    });

    // Grafico por institucion
    function institucion(desde, hasta){
        $.post(base_url('/institucion_json?desde='+desde+'&hasta='+hasta), function(data, status){
                
            var datos = $.parseJSON(data);

            $("h2.count-ins").text(datos.cantidad.cantidad);

            $.each(datos.grafico, function( index, value ){
                var count_y     = value.y;
                var name_string = value.name;
                var name_string = name_string.split(" ");

                value  = '<div class="col-lg-3">';
                value += '<div class="ibox float-e-margins">';
                value += '<div class="ibox-title">';
                value += '<h5 style="font-size:12px;">'+name_string[0]+'</h5>';
                value += '</div>';
                value += '<div class="ibox-content">';
                value += '<h1 class="no-margins font-bold text-navy">'+count_y+'</h1>';
                //value += '<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>';
                //value += '<small>Porcentaje</small>';
                value += '</div>';
                value += '</div>';
                value += '</div>';
                $('div#container-institucion-count').append(value);
            });
            
            $('#container-institucion').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: ''
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
                            }
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Indicador',
                    colorByPoint: true,
                    data: datos.grafico
                }]
            });    
        });
    }

    institucion(0, 0);

    $('#desde-institucion, #hasta-institucion').change(function(){
        var desde_institucion = $("#desde-institucion").val();
        var hasta_institucion = $("#hasta-institucion").val();

        if(desde_institucion ==0 && hasta_institucion ==0){
            institucion(0, 0);
        }else if(desde_institucion !=0 && hasta_institucion !=0){
            institucion(desde_institucion, hasta_institucion);
        }
    });

    function institucion_situacion_json(usuario_id, desde, hasta){
        // Grafico por institucion / Situacion
        var institucion_name = $("#institucion-name :selected").text();
        $.post(base_url('/institucion_situacion_json?usuario_id='+usuario_id+'&desde='+desde+'&hasta='+hasta), function(data, status){
            var datos = $.parseJSON(data);
            if(datos.cantidad.cantidad != 0){

                $("h2.count-ins-situacion").text(datos.cantidad.cantidad);
                $('#container-institucion-situacion').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: ''
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                formatter: function() {
                                    return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
                                }
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Indicador',
                        colorByPoint: true,
                        data: datos.grafico
                    }]
                }); 
            }else{
                //swal("Disculpe,", "no se encuentran registro asociados...");
                institucion_situacion_json(0,0,0);
            }
        });
    }

    // Carga automatica de Institucion / Situacion
    institucion_situacion_json(0,0,0);

    $('#institucion-name, #hashtags-id ,#desde-ins-sit, #hasta-ins-sit').change(function(){
        var usuario_id    = $("#institucion-name").val();
        var desde_ins_sit = $("#desde-ins-sit").val();
        var hasta_ins_sit = $("#hasta-ins-sit").val();
        if(usuario_id == 0){
            institucion_situacion_json(0,0,0);
        }else if(usuario_id !=0 && desde_ins_sit ==0 && hasta_ins_sit ==0){
            institucion_situacion_json(usuario_id, 0, 0);
        }else if(usuario_id !=0 && desde_ins_sit !=0 && hasta_ins_sit !=0){
            institucion_situacion_json(usuario_id, desde_ins_sit, hasta_ins_sit);
        }
    });

    // Estadisticas de Twitter por Mencion al Ciudadano Gobernador
    $.post(base_url('/mencion_json'), function(data, status){
        var datos = $.parseJSON(data);
        $("h1.count-bandeja-entrada").text(datos.bandeja_entrada.cantidad);
        $("h1.count-bandeja-politico").text(datos.bandeja_politico.cantidad);
        $("h1.count-bandeja-asistencial").text(datos.bandeja_asistencial.cantidad);
        $("h1.count-bandeja-operantes").text(datos.bandeja_operantes.cantidad);
        $("h1.count-bandeja-oponentes").text(datos.bandeja_oponentes.cantidad);
        $("h1.count-bandeja-individuales").text(datos.bandeja_individuales.cantidad);
        $("h1.count-bandeja-colectivos").text(datos.bandeja_colectivos.cantidad);
        $("h1.count-bandeja-respuestas").text(datos.bandeja_respuestas.cantidad);
        $("h1.count-bandeja-resueltos").text(datos.bandeja_resueltos.cantidad);
        $("h1.count-bandeja-observaciones").text(datos.bandeja_observaciones.cantidad);
    });

    $.post(base_url('/mencion_etiqueta_json'), function(data, status){
            
        var datos = $.parseJSON(data);

        $.each(datos, function( index, value ){
            var count_y     = value.cantidad;
            $("h1.count-menciones-etiqueta").text(count_y);
        });
    });
});