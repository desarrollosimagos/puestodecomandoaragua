<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CBandejaRespuestas extends CI_Controller {

	public function __construct() {
        parent::__construct();
       
		// Load database
        $this->load->model('MBandejaRespuestas');
        $this->load->model('MBandejaEntrada');
		
    }
	
	public function index(){
		$this->load->view('base');
		$this->load->view('bandejas/bandeja_respuestas');
		$this->load->view('footer');
	}
	
	public function ajax_respuestas(){
		
		// Añadimos un filtrado por el id del perfil del usuario logueado
		$fetch_data = $this->MBandejaRespuestas->make_datatables($this->session->userdata('logged_in')['profile_id']);
		//~ $consulta_ejecutada = $this->db->last_query();
		//~ echo $consulta_ejecutada;
		//~ echo count($fetch_data);
		$data = array();
		foreach($fetch_data as $row){
			
			$sub_array = array();
			
			$sub_array[] = "<a class='verId' title='Ver time-line'>".$row->id_str."</a>";
			$sub_array[] = "<a class='verName' title='Detalles de cuenta'>".$row->screen_name."</a>";
			$sub_array[] = "<a class='verText' title='Ver time-line' id='".$row->id_str."'>".$row->text."</a>";
			$sub_array[] = $row->created_at;
			//~ $sub_array[] = $select;
			$bot;
			if($row->bot == 0){$bot = "No";}else{$bot = "<span style='color:#D33333;'>Sí</span>";}
			$sub_array[] = $bot;
			$sub_array[] = $row->name;
			$sub_array[] = "<a class='resuelto' id='".$row->id_str.";".$row->status.";".$row->perfil_id."'><button class='btn btn-outline btn-primary dim' type='button'>Resuelto</button></a>";
			
			$data[] = $sub_array;
		}
		
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->MBandejaRespuestas->get_all_data($this->session->userdata('logged_in')['profile_id']),
			"recordsFiltered" => $this->MBandejaRespuestas->get_filtered_data($this->session->userdata('logged_in')['profile_id']),
			"data" => $data
		);
		
		echo json_encode($output);
		
	}
	
	// Método para cambiar un tweet a una determinada nueva bandeja
	public function cambio_bandeja(){
		
		$id_tweet = $this->input->post('id');
		//~ $id_perfil = $this->input->post('id_perfil');
		$id_perfil = $this->session->userdata('logged_in')['profile_id'];
		$nueva_bandeja = $this->input->post('nueva_bandeja');
		$mensaje = $this->input->post('mensaje');
		
		// Indicamos a qué tabla será movido el tweet
		$tabla = "bandeja_resueltos";
		$accion = "Resuelto";
		
		// Consultamos los datos del tweet correspondiente al id dado
		$datos_tweet = $this->MBandejaRespuestas->obtenerTweet($id_tweet);
		
		// Armamos los datos a registrar del tweet
		$data = array(
			'screen_name' => $datos_tweet[0]->screen_name,
			'id_str' => $datos_tweet[0]->id_str,
			'text' => $datos_tweet[0]->text,
			'created_at' => date('Y-m-d'),
			'status' => 1,
			'perfil_id' => $id_perfil
		);
		
		// Registramos el tweet
		$insert = $this->MBandejaEntrada->insert($tabla, $data);
		
		if($insert){
			
			// Actualizamos el status del tweet en la tabla 'bandeja_respuestas'
			$data2 = array(
				'id_str' => $id_tweet,
				'asignacion' => $nueva_bandeja,
				'status' => 0
			);
			
			$update = $this->MBandejaEntrada->update_status('bandeja_respuestas', $data2);
			
			
			// Registramos la acción en la tabla 'time_line'
			$data_bitacora = array(
				'fecha' => date('Y-m-d H:i:s'),
				'usuario' => $this->session->userdata('logged_in')['id'],
				'mensaje' => $mensaje,
				'accion' => $accion,
				'tweet_id' => $id_tweet
			);
			
			$time_line = $this->MBandejaEntrada->insert_time_line($data_bitacora);
			
			
			if($update && $time_line){
				
				echo '{"response":"ok"}';
				
			}
			
		}else{
			
			echo '{"response":"error"}';
			
		}
	}
	
	// Método para saber el número total de respuestas pendientes del usuario logueado
	public function respuestas_pendientes(){
		
		$output = array(
			"recordsTotal" => $this->MBandejaRespuestas->get_all_data($this->session->userdata('logged_in')['profile_id'])
		);
		
		echo json_encode($output);
		
	}
	
}
