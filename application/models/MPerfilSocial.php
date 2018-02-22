<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MPerfilSocial extends CI_Model {


    public function __construct() {
       
        parent::__construct();
        $this->load->database();
    }

    //Public method to obtain the perfil
    public function obtener() {
        $query = $this->db->get('perfil');

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }

    // Public method to insert the data
    public function insert($datos) {
        $result = $this->db->where('cedula =', $datos['cedula']);
        $result = $this->db->get('perfil');
        if ($result->num_rows() > 0) {
            return 'existe';
        } else {
            $result = $this->db->insert("perfil", $datos);
            $id = $this->db->insert_id();
            return $id;
        }
    }

    // Public method to insert the data
    public function insert_asoc($datos) {
        $this->db->where('perfil_id =', $datos['perfil_id']);
        $this->db->where('twitter_id =', $datos['twitter_id']);
        $result = $this->db->get('twitter_perfil');
        if ($result->num_rows() == 0) {
            $result = $this->db->insert("twitter_perfil", $datos);
            $id = $this->db->insert_id();
            return $id;
        }else{
			return 'existe';
		}
    }

    // Public method to obtain the perfil by id
    public function obtenerPerfil($id) {
		
        $this->db->where('id', $id);
        
        $query = $this->db->get('perfil');
        
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
            
    }

    // Public method to obtain the perfil by cedula
    public function obtenerPerfilCedula($cedula) {
		
        $this->db->where('cedula', $cedula);
        
        $query = $this->db->get('perfil');
        
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
            
    }

    // Public method to obtain the perfil_twitter
    public function obtenerPerfilTwitter($perfil_id, $twitter_id) {
		
        $this->db->where('perfil_id', $perfil_id);
        $this->db->where('twitter_id', $twitter_id);
        
        $query = $this->db->get('twitter_perfil');
        
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
            
    }

    // Public method to update a record  
    public function update($datos) {
        $result = $this->db->where('cedula =', $datos['cedula']);
        $result = $this->db->where('id !=', $datos['id']);
        $result = $this->db->get('perfil');

        if ($result->num_rows() > 0) {
            echo '1';
        } else {
            $result = $this->db->where('id', $datos['id']);
            $result = $this->db->update('perfil', $datos);
            return $result;
        }
    }


    // Public method to delete a record
     public function delete($id) {
		 
        $result = $this->db->where('service_id =', $id);
        $result = $this->db->get('franchises_perfil');

        if ($result->num_rows() > 0) {
            echo 'existe';
        } else {
            $result = $this->db->delete('perfil', array('id' => $id));
            return $result;
        }
       
    }
    

}
?>
