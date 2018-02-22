<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CBandejaResueltos extends CI_Controller {

	public function __construct() {
        parent::__construct();
       
		// Load database
        $this->load->model('MBandejaResueltos');
        $this->load->model('MBandejaEntrada');
		
    }
	
	public function index(){
		$this->load->view('base');
		$this->load->view('bandejas/bandeja_resueltos');
		$this->load->view('footer');
	}
	
	public function ajax_resueltos(){
		
		// Añadimos un filtrado por el id del perfil del usuario logueado
		$fetch_data = $this->MBandejaResueltos->make_datatables($this->session->userdata('logged_in')['profile_id']);
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
			
			$data[] = $sub_array;
		}
		
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->MBandejaResueltos->get_all_data($this->session->userdata('logged_in')['profile_id']),
			"recordsFiltered" => $this->MBandejaResueltos->get_filtered_data($this->session->userdata('logged_in')['profile_id']),
			"data" => $data
		);
		
		echo json_encode($output);
		
	}
	
}
