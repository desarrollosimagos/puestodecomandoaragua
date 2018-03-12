<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CGrafico extends CI_Controller {

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
		$param['desde']       = $this->input->get('desde');
		$param['hasta']       = $this->input->get('hasta');
        $response['grafico']  = $this->grafico->grafico_operador($param);
        //echo $this->db->last_query(); exit;
        $response['cantidad'] = $this->grafico->count_operador($param);
        echo json_encode($response, JSON_NUMERIC_CHECK);
	}

	// Grafico institucion, cada institucion se le asigna una serie de twt y estos se encargan de gestionarlos
	public function grafico_institucion()
	{
		$param['desde']       = $this->input->get('desde');
		$param['hasta']       = $this->input->get('hasta');
        $response['grafico']  = $this->grafico->grafico_institucion($param);
        $response['cantidad'] = $this->grafico->count_institucion($param);
        echo json_encode($response, JSON_NUMERIC_CHECK);
	}

	// Grafico institucion / Situaciones, cada institucion se le asigna una serie de twt y estos se encargan de gestionarlos
	public function grafico_institucion_situacion()
	{	
		$param['usuario_id']  = $this->input->get('usuario_id');
		$param['desde']       = $this->input->get('desde');
		$param['hasta']       = $this->input->get('hasta');
        $response['grafico']  = $this->grafico->grafico_institucion_situacion($param);
        //echo $this->db->last_query(); exit;
        $response['cantidad'] = $this->grafico->count_institucion_situacion($param);
        echo json_encode($response, JSON_NUMERIC_CHECK);
	}

	// Estadisticas de Twitter por Mencion
	public function grafico_bandeja()
	{
        $response['bandeja_entrada'] = $this->grafico->bandeja_entrada();
        $response['bandeja_politico'] = $this->grafico->bandeja_politico();
        $response['bandeja_asistencial'] = $this->grafico->bandeja_asistencial();
        $response['bandeja_operantes'] = $this->grafico->bandeja_operantes();
        echo json_encode($response);
	}

	// Estadisticas de Twitter por Mencion
	public function grafico_mencion_etiqueta()
	{
        $response = $this->grafico->grafico_mencion_etiqueta();
        echo json_encode($response);
	}


}
