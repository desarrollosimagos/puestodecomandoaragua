<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MBandejaResueltos extends CI_Model {
	
	var $table = "bandeja_resueltos b_r";
	
	var $select_column = array(
		"b_r.id", 
		"b_r.screen_name", 
		"b_r.id_str", 
		"b_r.text", 
		"b_r.created_at", 
		"b_r.asignacion",
		"b_r.bot",
		"b_r.status",
		"p.name",
		"b_r.perfil_id"
	);
	
	var $order_column = array(
		"b_r.screen_name", 
		"b_r.id_str", 
		"b_r.text", 
		"b_r.created_at", 
		"b_r.asignacion",
		"b_r.bot",
		"p.name"
	);


    public function __construct() {
       
        parent::__construct();
        $this->load->database();
    }

    // Public method to obtain the twitters
    public function obtener() {
        $query = $this->db->get('bandeja_resueltos');

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }

    // Método público para construir la consulta
    public function make_query($profile_id) {
        $this->db->select($this->select_column);
        //~ $this->db->distinct();
		$this->db->from($this->table);
		$this->db->join('profile p', 'p.id = b_r.perfil_id');
		// Si el perfil corresponde al de un administrador quitamos el filtro de perfil
        if($this->session->userdata('logged_in')['profile_id'] != 1){
			$this->db->join('grupos_bandejas_perfiles g_b_p', 'g_b_p.perfil_id = p.id');
			$this->db->where('p.id =', $profile_id);
		}
        $this->db->where('b_r.status =', 1);
		if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] != ""){
			$condicionales_like = "(b_r.screen_name LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_r.id_str LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_r.text LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_r.created_at LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_r.asignacion LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_r.bot LIKE '%".$_POST["search"]["value"]."%')";
			$this->db->where($condicionales_like);
		}
		if(isset($_POST["order"])){
			$this->db->order_by($this->order_column[$_POST["order"]["0"]["column"]], $_POST["order"]["0"]["dir"]);
		}else{
			$this->db->order_by("id", "DESC");
		}
    }
    
    // Método público para ejecutar la consulta
    public function make_datatables($profile_id){
		$this->make_query($profile_id);
		if($_POST["length"] != -1){
			$this->db->limit($_POST["length"], $_POST["start"]);
		}
		$query = $this->db->get();
		return $query->result();		
	}
	
	// Método público para obtener el número de registros resultantes de make_query()
	public function get_filtered_data($profile_id){
		$this->make_query($profile_id);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	// Método público para obtener el número total de registros de la bandeja de respuestas en estatus 1
	public function get_all_data($profile_id){
		$this->db->select($this->select_column);
		$this->db->from($this->table);
		$this->db->join('profile p', 'p.id = b_r.perfil_id');
		// Si el perfil corresponde al de un administrador quitamos el filtro de perfil
        if($this->session->userdata('logged_in')['profile_id'] != 1){
			$this->db->join('grupos_bandejas_perfiles g_b_p', 'g_b_p.perfil_id = p.id');
			$this->db->where('p.id =', $profile_id);
		}
		$this->db->where('b_r.status =', 1);
		return $this->db->count_all_results();
	}
	
	// Método público para consultar los datos de un tweet según su id
    public function obtenerTweet($tweet_id) {
        $this->db->where('id_str', $tweet_id);
        $query = $this->db->get('bandeja_resueltos');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
	
	// Método público para consultar el grupo de bandejas al que pertenece un determinado perfil
    public function getGroupProfile($profile_id) {
        $this->db->where('perfil_id', $profile_id);
        $query = $this->db->get('grupos_bandejas_perfiles');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }

}
?>
