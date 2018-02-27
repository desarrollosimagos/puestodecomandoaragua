$(document).ready(function () {


	// Funcion para capturar path
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


});