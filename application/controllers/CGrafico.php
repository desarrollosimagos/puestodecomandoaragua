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
        $response['grafico']  = $this->grafico->grafico_operador();
        $response['cantidad'] = $this->grafico->count_operador();
        echo json_encode($response, JSON_NUMERIC_CHECK);
	}

	// Grafico institucion, cada institucion se le asigna una serie de twt y estos se encargan de gestionarlos
	public function grafico_institucion()
	{
        $response['grafico']  = $this->grafico->grafico_institucion();
        $response['cantidad'] = $this->grafico->count_institucion();
        echo json_encode($response, JSON_NUMERIC_CHECK);
	}

	// Grafico institucion / Situaciones, cada institucion se le asigna una serie de twt y estos se encargan de gestionarlos
	public function grafico_institucion_situacion()
	{
        $response['grafico']  = $this->grafico->grafico_institucion_situacion();
        $response['cantidad'] = $this->grafico->count_institucion_situacion();
        echo json_encode($response, JSON_NUMERIC_CHECK);
	}

	// Estadisticas de Twitter por Mencion
	public function grafico_mencion()
	{
        $response = $this->grafico->grafico_mencion();
        echo json_encode($response);
	}

	// Estadisticas de Twitter por Mencion
	public function grafico_mencion_etiqueta()
	{
        $response = $this->grafico->grafico_mencion_etiqueta();
        echo json_encode($response);
	}


}
