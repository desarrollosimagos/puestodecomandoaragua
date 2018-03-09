<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load Model
        $this->load->model('MSituacion','situacion');
        $this->load->model('MPerfil','perfil');
        $this->import_situaciones();
    }

	// Show login page
    public function home() {
		// Borrar la cache de sesión manualmente
		//$this->session->sess_destroy();
		$this->load->view('base');
		$data['situacion'] = $this->situacion->obtener();
		$data['profile'] = $this->perfil->obtener();
		$this->load->view('grafico/grafico', $data);
		$this->load->view('footer');
		//~ $this->basicauthpublic->logout();
    }

    public function import_situaciones() {
        
        $ruta = getcwd();  // Obtiene el directorio actual en donde se está trabajando
        
        $arreglo_cadena = fopen ($ruta."/application/migrations/hashtags_twitter.csv","r");

        while ($data = fgetcsv ($arreglo_cadena, 1000, ",")) {
        	$hashtags = $data[1];
        	$data = array(
				'name' => $hashtags,
				'description' => $hashtags,
				'd_create' => date('Y-m-d H:i:s'),
				'd_update' => date('Y-m-d H:i:s'),

			);
			
			$this->situacion->add($data);
        }

    }

}