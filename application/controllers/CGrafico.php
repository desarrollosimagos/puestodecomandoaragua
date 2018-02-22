<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CGrafico extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        parent::__construct();
        
		// Load database
        $this->load->model('MGrafico','grafico');
    }
	 
	public function index()
	{
		// Cargamos la plantilla grafico de operadores
		$this->load->view('base');
		$this->load->view('grafico/grafico');
		$this->load->view('footer');
	}

	// Grafico operador
	public function grafico_operador()
	{
        $response = $this->grafico->grafico_operador();
        echo json_encode($response, JSON_NUMERIC_CHECK);
	}

	// Grafico institucion, cada insttitucion se le asigna una serie de twt y estos se encargan de gestionarlos
	public function grafico_institucion()
	{
        $response = $this->grafico->grafico_institucion();
        echo json_encode($response, JSON_NUMERIC_CHECK);
	}


}
