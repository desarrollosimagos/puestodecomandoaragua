<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MTweet extends CI_Model {


    public function __construct() {
       
        parent::__construct();
        $this->load->database();
    }
    
    //Public method to obtain all tiem-line
    public function obtener() {
        $query = $this->db->get('time_line');

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
    
    //Public method to obtain the data of inbox
    public function data_inbox($tweet_id) {
		
        $this->db->where('id_str', $tweet_id);
        $query = $this->db->get('bandeja_entrada');
		
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
            
    }
    
    //Public method to obtain the tiem-line
    public function time_line($tweet_id) {
		
        $this->db->select('t_l.id, t_l.fecha, t_l.usuario, t_l.mensaje, t_l.accion, t_l.tweet_id, b_e.screen_name, b_e.text, u.username, u.name, u.lastname');
		$this->db->from('time_line t_l');
		$this->db->join('bandeja_entrada b_e', 'b_e.id_str = t_l.tweet_id');
		$this->db->join('users u', 'u.id = t_l.usuario');
        $this->db->where('t_l.tweet_id =', $tweet_id);
        $this->db->order_by("t_l.id", "asc");
		
		$query = $this->db->get();
		
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
            
    }

}
?>
