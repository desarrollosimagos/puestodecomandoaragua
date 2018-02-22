<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MTwitter extends CI_Model {
	
	var $table = "twitter tw";
	
	var $select_column = array(
		"tw.id", 
		"tw.screen_name", 
		"tw.name", 
		"tw.location", 
		"tw.url", 
		"tw.description",
		"tw.followers_count",
		"tw.friends_count",
		"tw.listed_count",
		"tw.favorites_count",
		"tw.statuses_count",
		"tw.profile_image_url"
	);
	
	var $order_column = array(
		"tw.screen_name", 
		"tw.name", 
		"tw.location", 
		"tw.url", 
		"tw.description",
		"tw.followers_count",
		"tw.friends_count",
		"tw.listed_count",
		"tw.favorites_count",
		"tw.statuses_count"
	);


    public function __construct() {
       
        parent::__construct();
        $this->load->database();
    }

    // Public method to obtain the twitters
    public function obtener() {
        $query = $this->db->get('twitter');

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }

    // Método público para construir la consulta
    public function make_query() {
        $this->db->select($this->select_column);
        //~ $this->db->distinct();
		$this->db->from($this->table);
		if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] != ""){
			$condicionales_like = "(tw.screen_name LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "tw.name LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "tw.location LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "tw.url LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "tw.description LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "tw.followers_count LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "tw.friends_count LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "tw.listed_count LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "tw.favorites_count LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "tw.statuses_count LIKE '%".$_POST["search"]["value"]."%')";
			$this->db->where($condicionales_like);
		}
		if(isset($_POST["order"])){
			$this->db->order_by($this->order_column[$_POST["order"]["0"]["column"]], $_POST["order"]["0"]["dir"]);
		}else{
			$this->db->order_by("id", "DESC");
		}
    }
    
    // Método público para ejecutar la consulta
    public function make_datatables(){
		$this->make_query();
		if($_POST["length"] != -1){
			$this->db->limit($_POST["length"], $_POST["start"]);
		}
		$query = $this->db->get();
		return $query->result();		
	}
	
	// Método público para obtener el número de registros resultantes de make_query()
	public function get_filtered_data(){
		$this->make_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	// Método público para obtener el número total de registros de la bandeja de entrada en estatus 1
	public function get_all_data(){
		$this->db->select($this->select_column);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	
	// Método público para registrar un tweet en una determinada tabla de bandeja x
    public function insert($tabla, $datos) {
        
		$result = $this->db->insert($tabla, $datos);
		return $result;
            
    }
    
    // Método público para consultar los datos de un twitter según su nombre
    public function obtenerTwitter($twitter_name) {
		
        $this->db->where('screen_name', $twitter_name);
        $query = $this->db->get('twitter');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
            
    }
    
    // Método público para consultar los datos de un twitter según su id
    public function obtenerTwitterById($twitter_id) {
		
        $this->db->where('id', $twitter_id);
        $query = $this->db->get('twitter');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
            
    }
    
    
    //Public method to obtain the tienda
    public function perfiles_asociados($twitter_id) {
		
        $this->db->select('p.id, p.cedula, p.genero, p.nombre, p.apellido, p.telefono, p.celular, p.correo, p.centro_votacion, p.direccion_centro_votacion, p.facebook');
		$this->db->from('twitter_perfil t_p');
		$this->db->join('twitter t', 't.id = t_p.twitter_id');
		$this->db->join('perfil p', 'p.id = t_p.perfil_id');
        $this->db->where('t_p.twitter_id =', $twitter_id);
		
		$query = $this->db->get();
		
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
            
    }
    
    // Método público para consultar los mensajes que ha recibido el twitter
    public function obtenerMensajes($twitter_name) {
		
        $this->db->where('screen_name', $twitter_name);
        $query = $this->db->get('mensajes_recibidos');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
            
    }
	
	// Método público para actualizar el estatus de un tweet en la bandeja de donde viene
    public function update_status($tabla, $datos) {
		
		$result = $this->db->where('id', $datos['id']);
		$result = $this->db->update($tabla, $datos);
		return $result;
		
    }
	
	// Método público para desasociar un perfil de una cuenta de twitter
    public function quitar_perfil($perfil_id, $twitter_id) {
		
		$result = $this->db->delete('twitter_perfil', array('perfil_id' => $perfil_id, 'twitter_id' => $twitter_id));
		return $result;
		
    }

}
?>
