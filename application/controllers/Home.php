<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Load Model
        $this->load->model('MSituacion','situacion');
        $this->load->model('MPerfil','perfil');
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

}