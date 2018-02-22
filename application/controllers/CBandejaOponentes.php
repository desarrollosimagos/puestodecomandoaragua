<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CBandejaOponentes extends CI_Controller {

	public function __construct() {
        parent::__construct();
       
		// Load database
        $this->load->model('MBandejaOponentes');
        $this->load->model('MBandejaEntrada');
		
    }
	
	public function index(){
		$this->load->view('base');
		$this->load->view('bandejas/bandeja_oponente');
		$this->load->view('footer');
	}
	
	public function ajax_oponentes(){
		
		// Buscamos los perfiles asociados al grupo de bandejas 'Político'
		$perfiles_politicos = $this->MBandejaOponentes->getProfileByGroup(1);
		
		$fetch_data = $this->MBandejaOponentes->make_datatables();
		//~ $consulta_ejecutada = $this->db->last_query();
		//~ echo $consulta_ejecutada;
		//~ echo count($fetch_data);
		$data = array();
		foreach($fetch_data as $row){
			
			$sub_array = array();
			
			// Proceso para la creación del combo select de asignación
			$select = "<select class='form-control cambiar' style='width:100%' id='".$row->id_str.";".$row->status."'>";
			$select .="<option value='0'>Seleccione</option>";
			foreach($perfiles_politicos as $perfil_politico){
				$select .="<option value='".$perfil_politico->id."'>".$perfil_politico->name."</option>";
			}
			$select .="</select>";
			
			$sub_array[] = "<a class='verId' title='Ver time-line'>".$row->id_str."</a>";
			$sub_array[] = "<a class='verName' title='Detalles de cuenta'>".$row->screen_name."</a>";
			$sub_array[] = "<a class='verText' title='Ver time-line' id='".$row->id_str."'>".$row->text."</a>";
			$sub_array[] = $row->created_at;
			//~ $sub_array[] = $select;
			$bot;
			if($row->bot == 0){$bot = "No";}else{$bot = "<span style='color:#D33333;'>Sí</span>";}
			$sub_array[] = $bot;
			$sub_array[] = $select;
			$sub_array[] = "<a class='observacion' id='".$row->id_str.";".$row->status."'><button class='btn btn-outline btn-primary dim' type='button'>Observación</button></a>";
			
			$data[] = $sub_array;
		}
		
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->MBandejaOponentes->get_all_data(),
			"recordsFiltered" => $this->MBandejaOponentes->get_filtered_data(),
			"data" => $data
		);
		
		echo json_encode($output);
		
	}
	
	// Método para cambiar un tweet a una determinada nueva bandeja
	public function cambio_bandeja(){
		
		$id_tweet = $this->input->post('id');
		$id_perfil = $this->input->post('id_perfil');
		$nueva_bandeja = $this->input->post('nueva_bandeja');
		$mensaje = $this->input->post('mensaje');
		
		// Comprobamos a qué tabla será movido el tweet
		if($nueva_bandeja == "Respuestas"){
			$tabla = "bandeja_respuestas";
			$accion = "Asignado a bandeja de respuestas";
		}else if($nueva_bandeja == "Observaciones"){
			$tabla = "bandeja_observaciones";
			$accion = "Asignado a bandeja observaciones";
		}		
		
		// Consultamos los datos del tweet correspondiente al id dado
		$datos_tweet = $this->MBandejaOponentes->obtenerTweet($id_tweet);
		
		// Armamos los datos a registrar del tweet
		$data = array(
			'screen_name' => $datos_tweet[0]->screen_name,
			'id_str' => $datos_tweet[0]->id_str,
			'text' => $datos_tweet[0]->text,
			'created_at' => date('Y-m-d'),
			'asignacion' => '',
			'bot' => $datos_tweet[0]->bot,
			'status' => 1
		);
		
		if($nueva_bandeja == "Observaciones"){
			$data['perfil_id'] = $this->session->userdata['logged_in']['profile_id'];
		}else{
			$data['perfil_id'] = $id_perfil;
		}
		
		// Registramos el tweet
		$insert = $this->MBandejaEntrada->insert($tabla, $data);
		
		if($insert){
			
			// Actualizamos el status del tweet en la tabla 'bandeja_oponentes'
			$data2 = array(
				'id_str' => $id_tweet,
				'asignacion' => $nueva_bandeja,
				'status' => 0
			);
			
			$update = $this->MBandejaEntrada->update_status('bandeja_oponentes', $data2);
			
			
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
	
}
