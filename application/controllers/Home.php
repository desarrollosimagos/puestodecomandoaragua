<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load Model
        $this->load->model('MSituacion','situacion');
        $this->load->model('MPerfil','perfil');
        $this->load->model('MGrafico','grafico');
        $this->import_situaciones();
    }

	// Show login page
    public function home() {
        $profile_id = $this->session->userdata('logged_in')['profile_id'];
		$data['situacion'] = $this->situacion->obtener();
		$data['profile'] = $this->perfil->obtener();
        $data['hashtags'] = $this->grafico->get_hashtags();
        $this->load->view('base');
        if($profile_id == 1 || $profile_id == 27){
            $this->load->view('grafico/grafico', $data);
        }
		$this->load->view('footer');
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