$(document).ready(function () {

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

    Highcharts.setOptions({
        lang: {
                printChart: "Imprimir Gráfico",
                decimalPoint: ',',
                downloadPNG: 'Descargar imágen en PNG',
                downloadJPEG: 'Descargar imágen en JPEG',
                downloadPDF: 'Descargar documento en PDF',
                downloadSVG: 'Descargar imágen en formato Vectorial',
                exportButtonTitle: 'Exportar Gráfico',
                loading: 'Cargaando...',
                printButtonTitle: 'Imprimir Gráfico',
                resetZoom: 'Restablecer zoom',
                resetZoomTitle: 'Restablecer el zoom al nivel 1: 1',
                thousandsSep: ' ',
                decimalPoint: ','
            }
        });
        
        // Themes Highcharts
        Highcharts.theme = {
        colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
                 '#FF9655', '#FFF263', '#6AF9C4'],
        chart: {
            backgroundColor: {
                linearGradient: [0, 0, 500, 500],
                stops: [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(240, 240, 255)']
                ]
            },
        },
        title: {
            style: {
                color: '#000',
                font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
            }
        },
        subtitle: {
            style: {
                color: '#666666',
                font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
            }
        },

        legend: {
            itemStyle: {
                font: '9pt Trebuchet MS, Verdana, sans-serif',
                color: 'black'
            },
            itemHoverStyle:{
                color: 'gray'
            }   
        }
    };

    // Grafico por operador
    $.get(base_url('/operador_json'), function(data, status){
            
        var datos = $.parseJSON(data);

        $.each(datos, function( index, value ){
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
            $('div#container-operador-count').append(value);
        });
        
        $('#container-operador').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Estadisticas por Operadores'
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
                data: datos
            }]
        });
                
    });

    // Grafico por institucion
    $.get(base_url('/institucion_json'), function(data, status){
            
        var datos = $.parseJSON(data);

        $.each(datos, function( index, value ){
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
                text: 'Estadisticas por Institución'
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
                data: datos
            }]
        });
                
    });
});