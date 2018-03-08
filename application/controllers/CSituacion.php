<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CSituacion extends CI_Controller {

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
        $this->load->model('MSituacion','situacion');
    }
	 
	public function index()
	{
		$this->load->view('base');
		$data['listar'] = $this->situacion->obtener();
		$this->load->view('situacion/lista', $data);
		$this->load->view('footer');
	}

	public function register()
	{
		$this->load->view('base');
		$this->load->view('situacion/registrar');
		$this->load->view('footer');
	}

	// Método para editar
    public function edit($id) {
		$this->load->view('base');
        $data['detail'] = $this->situacion->obtenerSituacion($id);
        $this->load->view('situacion/editar', $data);
    }

	// Método para guardar un nuevo registro
    public function add() {
		
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'd_create' => date('Y-m-d H:i:s'),
			'd_update' => date('Y-m-d H:i:s'),

		);

        $this->situacion->add($data);
    }

    public function update() {
		
		$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'd_create' => date('Y-m-d H:i:s'),
			'd_update' => date('Y-m-d H:i:s'),

		);

        $this->situacion->update($data);
    }

    // Método para eliminar
	function delete($id) {
        $result = $this->situacion->delete($id);
    }

    public function ajax_situacion()
	{
		$text = $this->input->get('query');
		$response = $this->situacion->ajax_situacion($text);
		echo json_encode($response, JSON_NUMERIC_CHECK);
	}
}
