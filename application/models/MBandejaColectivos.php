<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MBandejaColectivos extends CI_Model {
	
	var $table = "bandeja_colectivos b_c";
	
	var $select_column = array(
		"b_c.id", 
		"b_c.screen_name", 
		"b_c.id_str", 
		"b_c.text", 
		"b_c.created_at", 
		"b_c.asignacion",
		"b_c.bot",
		"b_c.status"
	);
	
	var $order_column = array(
		"b_c.screen_name", 
		"b_c.id_str", 
		"b_c.text", 
		"b_c.created_at", 
		"b_c.asignacion",
		"b_c.bot"
	);


    public function __construct() {
       
        parent::__construct();
        $this->load->database();
    }

    // Public method to obtain the twitters
    public function obtener() {
        $query = $this->db->get('bandeja_colectivos');

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
        $this->db->where('b_c.status =', 1);
		if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] != ""){
			$condicionales_like = "(b_c.screen_name LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_c.id_str LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_c.text LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_c.created_at LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_c.asignacion LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_c.bot LIKE '%".$_POST["search"]["value"]."%')";
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
		$this->db->where('b_c.status =', 1);
		return $this->db->count_all_results();
	}
	
	// Método público para consultar los datos de un tweet según su id
    public function obtenerTweet($tweet_id) {
        $this->db->where('id_str', $tweet_id);
        $query = $this->db->get('bandeja_colectivos');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
    
    // Método para consultar los perfiles de un grupo de bandejas específico
    public function getProfileByGroup($group_id) {
        $this->db->select('p.id, p.name');
		$this->db->from('grupos_bandejas_perfiles g_b_p');
		$this->db->join('profile p', 'p.id = g_b_p.perfil_id');
        $this->db->where('g_b_p.grupo_bandeja_id =', $group_id);
		$query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }

}
?>
