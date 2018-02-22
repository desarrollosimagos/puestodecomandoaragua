<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CBandejaObservaciones extends CI_Controller {

	public function __construct() {
        parent::__construct();


       
		// Load database
        $this->load->model('MBandejaObservaciones');
        $this->load->model('MBandejaEntrada');
		
    }
	
	public function index(){
		
		$this->load->view('base');
		$this->load->view('bandejas/bandeja_observaciones');
		$this->load->view('footer');
		
	}
	
	public function ajax_observaciones(){
		
		$fetch_data = $this->MBandejaObservaciones->make_datatables();
		//~ $consulta_ejecutada = $this->db->last_query();
		//~ echo $consulta_ejecutada;
		//~ echo count($fetch_data);
		$data = array();
		foreach($fetch_data as $row){
			
			$sub_array = array();
			
			// Proceso para la creación del combo select de asignación
			$select = "<select class='form-control cambiar' style='width:100%' id='".$row->id_str.";".$row->status."'>";
			$select .="<option value='0'>Seleccione</option>";
			$select .="<option value='Entrada'>Entrada</option>";
			$select .="<option value='Político'>Político</option>";
			$select .="<option value='Asistencial'>Asistencial</option>";
			$select .="<option value='Cooperantes'>Cooperantes</option>";
			$select .="<option value='Oponentes'>Oponentes</option>";
			$select .="<option value='Individuales'>Individuales</option>";
			$select .="<option value='Colectivos'>Colectivos</option>";
			$select .="</select>";
			
			$sub_array[] = "<input type='checkbox' id='checkbox_".$row->id."' class='check'>";
			$sub_array[] = "<a class='verId' title='Ver time-line'>".$row->id_str."</a>";
			$sub_array[] = "<a class='verName' title='Detalles de cuenta'>".$row->screen_name."</a>";
			$sub_array[] = "<a class='verText' title='Ver time-line' id='".$row->id_str."'>".$row->text."</a>";
			$sub_array[] = $row->created_at;
			$sub_array[] = $select;
			$bot;
			if($row->bot == 0){$bot = "No";}else{$bot = "<span style='color:#D33333;'>Sí</span>";}
			$sub_array[] = $bot;
			$sub_array[] = "<a class='eliminar' style='color: #1ab394' id='".$row->id_str.";".$row->status."'><i class='fa fa-trash-o fa-2x'></i>";
			
			$data[] = $sub_array;
			
		}
		
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->MBandejaObservaciones->get_all_data(),
			"recordsFiltered" => $this->MBandejaObservaciones->get_filtered_data(),
			"data" => $data
		);
		
		echo json_encode($output);
		
	}
	
	// Método para cambiar un tweet a una determinada nueva bandeja
	public function cambio_bandeja(){
		
		$id_tweet = $this->input->post('id');
		$nueva_bandeja = $this->input->post('nueva_bandeja');
		$mensaje = $this->input->post('mensaje');
		
		// Comprobamos a qué tabla será movido el tweet
		if($nueva_bandeja == "Entrada"){
			$tabla = "bandeja_entrada";
			$accion = "Asignado a bandeja entrada";
		}else if($nueva_bandeja == "Político"){
			$tabla = "bandeja_politico";
			$accion = "Asignado a bandeja político";
		}else if($nueva_bandeja == "Asistencial"){
			$tabla = "bandeja_asistencial";
			$accion = "Asignado a bandeja asistencial";
		}else if($nueva_bandeja == "Cooperantes"){
			$tabla = "bandeja_operantes";
			$accion = "Asignado a bandeja cooperantes";
		}else if($nueva_bandeja == "Oponentes"){
			$tabla = "bandeja_oponentes";
			$accion = "Asignado a bandeja oponentes";
		}else if($nueva_bandeja == "Individuales"){
			$tabla = "bandeja_individuales";
			$accion = "Asignado a bandeja individuales";
		}else if($nueva_bandeja == "Colectivos"){
			$tabla = "bandeja_colectivos";
			$accion = "Asignado a bandeja colectivos";
		}
		
		// Consultamos los datos del tweet correspondiente al id dado
		$datos_tweet = $this->MBandejaObservaciones->obtenerTweet($id_tweet);
		
		// Armamos los datos a registrar del tweet
		$data = array(
			'screen_name' => $datos_tweet[0]->screen_name,
			'id_str' => $datos_tweet[0]->id_str,
			'text' => $datos_tweet[0]->text,
			'created_at' => date('Y-m-d'),
			'asignacion' => '',
			'bot' => $datos_tweet[0]->bot,
			'status' => 1,
		);
		
		// Registramos el tweet
		$insert = $this->MBandejaEntrada->insert($tabla, $data);
		
		if($insert){
			
			// Actualizamos el status del tweet en la tabla 'bandeja_observaciones'
			$data2 = array(
				'id_str' => $id_tweet,
				'asignacion' => $nueva_bandeja,
				'status' => 0
			);
			
			$update = $this->MBandejaEntrada->update_status('bandeja_observaciones', $data2);
			
			
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
	
	// Método para cambiar el status de una observación a 0 (cero)
	public function eliminar(){
		
		$id_tweet = $this->input->post('id');
		
		// Actualizamos el status del tweet en la tabla 'bandeja_observaciones'
		$data2 = array(
			'id_str' => $id_tweet,
			'asignacion' => 'Eliminado',
			'status' => 0
		);
		
		$update = $this->MBandejaEntrada->update_status('bandeja_observaciones', $data2);
		
		
		// Registramos la acción en la tabla 'time_line'
		$data_bitacora = array(
			'fecha' => date('Y-m-d H:i:s'),
			'usuario' => $this->session->userdata('logged_in')['id'],
			'mensaje' => 'Eliminado por el usuario '.$this->session->userdata('logged_in')['username'],
			'accion' => 'Eliminado por el usuario '.$this->session->userdata('logged_in')['username'],
			'tweet_id' => $id_tweet
		);
		
		$time_line = $this->MBandejaEntrada->insert_time_line($data_bitacora);
		
		
		if($update && $time_line){
			
			echo '{"response":"ok"}';
			
		}else{
		
			echo '{"response":"error"}';
			
		}
		
	}
	
	// Método para cambiar el status de una observación a 0 (cero)
	public function eliminar_multi(){
		
		$observaciones = $this->input->post('observaciones');
		
		// Si el arreglo trae registros se procede a hacer los registros correspondientes
		if(count($observaciones) > 0){
			foreach ($observaciones as $observacion) {
					
				// Actualizamos el status del tweet en la tabla 'bandeja_observaciones'
				$data2 = array(
					'id_str' => $observacion,
					'asignacion' => 'Eliminado',
					'status' => 0
				);
				
				$update = $this->MBandejaEntrada->update_status('bandeja_observaciones', $data2);
				
				
				// Registramos la acción en la tabla 'time_line'
				$data_bitacora = array(
					'fecha' => date('Y-m-d H:i:s'),
					'usuario' => $this->session->userdata('logged_in')['id'],
					'mensaje' => 'Eliminado por el usuario '.$this->session->userdata('logged_in')['username'],
					'accion' => 'Eliminado por el usuario '.$this->session->userdata('logged_in')['username'],
					'tweet_id' => $observacion
				);
				
				$time_line = $this->MBandejaEntrada->insert_time_line($data_bitacora);
				
				
				if($update && $time_line){
					
					echo '{"response":"ok"}';
					
				}else{
				
					echo '{"response":"error"}';
					
				}
				
			}
			
		}
		
	}
	
}
