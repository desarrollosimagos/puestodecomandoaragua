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
        $response['bandeja_entrada'] = $this->grafico->grafico_bandeja('bandeja_entrada');
        $response['bandeja_politico'] = $this->grafico->grafico_bandeja('bandeja_politico');
        $response['bandeja_asistencial'] = $this->grafico->grafico_bandeja('bandeja_asistencial');
        $response['bandeja_operantes'] = $this->grafico->grafico_bandeja('bandeja_operantes');
        $response['bandeja_oponentes'] = $this->grafico->grafico_bandeja('bandeja_oponentes');
        $response['bandeja_individuales'] = $this->grafico->grafico_bandeja('bandeja_individuales');
        $response['bandeja_colectivos'] = $this->grafico->grafico_bandeja('bandeja_colectivos');
        $response['bandeja_respuestas'] = $this->grafico->grafico_bandeja('bandeja_respuestas');
        $response['bandeja_resueltos'] = $this->grafico->grafico_bandeja('bandeja_resueltos');
        $response['bandeja_observaciones'] = $this->grafico->grafico_bandeja('bandeja_observaciones');
        echo json_encode($response);
	}

	// Estadisticas de Twitter por Mencion
	public function grafico_mencion_etiqueta()
	{
        $response = $this->grafico->grafico_mencion_etiqueta();
        echo json_encode($response);
	}

	// Estadisticas de hashtags del dia
	public function day_hashtags()
	{	$hashtags = $this->grafico->get_hashtags();
		foreach ($hashtags as $key => $value) {
			$data = $this->grafico->day_hashtags($value->name);
				$output = array(
				"draw" => intval($this->input->post('draw')),
				"recordsTotal" => $this->grafico->get_all_data(),
				"recordsFiltered" => $this->grafico->get_filtered_data(),
				"data" => $data
			);
	        echo json_encode($output);
		}
        
	}


}
