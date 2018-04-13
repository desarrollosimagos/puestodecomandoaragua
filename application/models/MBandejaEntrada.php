<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MBandejaEntrada extends CI_Model {
	
	var $table = "bandeja_entrada b_e";
	
	var $select_column = array(
		"b_e.id", 
		"b_e.screen_name", 
		"b_e.id_str", 
		"b_e.text", 
		"b_e.created_at", 
		"b_e.asignacion",
		"b_e.bot",
		"b_e.status"
	);
	
	var $order_column = array(
		"b_e.screen_name", 
		"b_e.id_str", 
		"b_e.text", 
		"b_e.created_at", 
		"b_e.asignacion",
		"b_e.bot"
	);


    public function __construct() {
       
        parent::__construct();
        $this->load->database();
    }

    // Public method to obtain the twitters
    public function obtener() {
        $query = $this->db->get('bandeja_entrada');

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
        $this->db->where('b_e.status =', 1);
		if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] != ""){
			$condicionales_like = "(b_e.screen_name LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_e.id_str LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_e.text LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_e.created_at LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_e.asignacion LIKE '%".$_POST["search"]["value"]."%' OR ";
			$condicionales_like .= "b_e.bot LIKE '%".$_POST["search"]["value"]."%')";
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
		$this->db->where('b_e.status =', 1);
		return $this->db->count_all_results();
	}

	// Método público para registrar time_line_situaciones
    public function insert_time_line_situaciones($datos) {
    	return $this->db->insert("time_line_situaciones", $datos);  
    }
	
	// Método público para registrar un tweet en una determinada tabla de bandeja x
    public function insert($tabla, $datos) {
		
		$result = $this->db->where('id_str =', $datos['id_str']);
        $result = $this->db->get($tabla);
        if ($result->num_rows() > 0) {
            $result = $this->db->where('id_str', $datos['id_str']);
			$result = $this->db->update($tabla, $datos);
			return $result;
        } else {
            $result = $this->db->insert($tabla, $datos);
			return $result;
        }
            
    }
	
	// Método público para registrar un movimiento en el time line
    public function insert_time_line($datos) {
		
		$result = $this->db->insert('time_line', $datos);
		return $result;
            
    }
    
    // Método público para consultar los datos de un tweet según su id
    public function obtenerTweet($tweet_id) {
        $this->db->where('id_str', $tweet_id);
        $query = $this->db->get('bandeja_entrada');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
	
	// Método público para actualizar el estatus de un tweet en la bandeja de donde viene
    public function update_status($tabla, $datos) {
		
		$result = $this->db->where('id_str', $datos['id_str']);
		$result = $this->db->update($tabla, $datos);
		return $result;
		
    }
    
	// Método público para actualizar el id_str de los registros de la bandeja de entrada
    public function update_idstr($tabla, $datos) {
		
		$result = $this->db->where('id', $datos['id']);
		$result = $this->db->update($tabla, $datos);
		return $result;
		
    }

}
?>
