<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CTwitter extends CI_Controller {

	public function __construct() {
        parent::__construct();


       
		// Load database
        $this->load->model('MTwitter');
		
    }
	
	public function index(){
		$this->load->view('base');
		$this->load->view('perfil_twitter/lista');
		$this->load->view('footer');
	}
	
	public function ajax_twitters(){
		
		$fetch_data = $this->MTwitter->make_datatables();
		//~ $consulta_ejecutada = $this->db->last_query();
		//~ echo $consulta_ejecutada;
		//~ echo count($fetch_data);
		$data = array();
		foreach($fetch_data as $row){
			
			$sub_array = array();
			
			$sub_array[] = "<a class='verId'>".$row->id."</a>";
			$sub_array[] = "<a class='verName'>".$row->screen_name."</a>";
			$sub_array[] = $row->name;
			$sub_array[] = $row->url;
			$sub_array[] = $row->followers_count;
			$sub_array[] = $row->friends_count;
			$sub_array[] = $row->favorites_count;
			$sub_array[] = "<a ><img alt='image' class='img-circle m-t-xs img-responsive' src='".$row->profile_image_url."'></a>";
			
			$data[] = $sub_array;
		}
		
		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->MTwitter->get_all_data(),
			"recordsFiltered" => $this->MTwitter->get_filtered_data(),
			"data" => $data
		);
		
		echo json_encode($output);
		
	}
	
	// Método para ver los datos de un twitter
	public function view(){
		
		$twitter_name = $this->input->get('screen_name');
		$ruta_origen = $this->input->get('ruta');
		
		if($twitter_name == ''){
			
			$data = array(
				'heading' => "404 Page Not Found",
				'message' => "The page you requested was not found."
			);
			
			$this->load->view('base');
			$this->load->view('errors/html/error_404', $data);
			$this->load->view('footer');
			
		}else{
			
			// Consultamos los datos del twitter correspondiente al nombre dado
			$datos_twitter = $this->MTwitter->obtenerTwitter($twitter_name);
			
			// Buscamos los perfiles asociados a la cuenta y armamos una lista para enviarla a la vista también
			$perfiles = $this->MTwitter->perfiles_asociados($datos_twitter[0]->id);
			
			// Consultamos los mensajes recibidos correspondiente al nombre dado
			$mensajes = $this->MTwitter->obtenerMensajes($twitter_name);
			
			// Armamos los datos a registrar del twitter
			$data = array(
				'id' => $datos_twitter[0]->id,
				'screen_name' => $datos_twitter[0]->screen_name,
				'name' => $datos_twitter[0]->name,
				'location' => $datos_twitter[0]->location,
				'url' => $datos_twitter[0]->url,
				'description' => $datos_twitter[0]->description,
				'followers_count' => $datos_twitter[0]->followers_count,
				'friends_count' => $datos_twitter[0]->friends_count,
				'listed_count' => $datos_twitter[0]->listed_count,
				'favorites_count' => $datos_twitter[0]->favorites_count,
				'statuses_count' => $datos_twitter[0]->statuses_count,
				'profile_image_url' => $datos_twitter[0]->profile_image_url,
				'ruta_origen' => $ruta_origen,
				'perfiles' => $perfiles,
				'num_mensajes' => count($mensajes)
			);
			
			$this->load->view('base');
			$this->load->view('perfil_twitter/perfil_twitter', $data);
			$this->load->view('footer');
			
		}
		
	}
	
	
	// Método para quitar un perfil de un twitter
	public function quitar(){
		
		$perfil_id = $this->input->post('perfil_id');
		$twitter_id = $this->input->post('twitter_id');
		
		$quitar = $this->MTwitter->quitar_perfil($perfil_id, $twitter_id);
		
		if($quitar){
			
			echo '{"response":"ok"}';
			
		}
		
	}
	
}
