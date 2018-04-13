<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTweet extends CI_Controller {

	public function __construct() {
        parent::__construct();


       
		// Load database
        $this->load->model('MTweet');
		
    }
	
	public function index(){
		$this->load->view('base');
		$this->load->view('time_line/time_line');
		$this->load->view('footer');
	}
	
	// Método para ver los datos de un twitter
	public function time_line(){
		
		$tweet_id = $this->input->get('id_str');
		$ruta_origen = $this->input->get('ruta');
		
		if($tweet_id == ''){
			
			$data = array(
				'heading' => "404 Page Not Found",
				'message' => "The page you requested was not found."
			);
			
			$this->load->view('base');
			$this->load->view('errors/html/error_404', $data);
			$this->load->view('footer');
			
		}else{
		
			// Buscamos el registro del tweet en la tabla 'bandeja_entrada'
			$data_inbox = $this->MTweet->data_inbox($tweet_id);
		
			// Buscamos los registros del tweet en la tabla 'time_line'
			$time_line = $this->MTweet->time_line($tweet_id);
			
			// Armamos los datos a mostrar
			$data['data_inbox'] = $data_inbox;
			$data['time_line'] = $time_line;
			$data['ruta_origen'] = $ruta_origen;
			
			$this->load->view('base');
			$this->load->view('time_line/time_line', $data);
			$this->load->view('footer');
		
		}
		
	}
	
}
