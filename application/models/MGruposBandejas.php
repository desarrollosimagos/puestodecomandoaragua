<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MGruposBandejas extends CI_Model {


    public function __construct() {
       
        parent::__construct();
        $this->load->database();
    }

    //Public method to obtain the grupos_bandejas
    public function obtener() {
        $query = $this->db->get('grupos_bandejas');

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
    
    //Public method to obtain the profiles asociated
    public function obtener_perfiles() {
        $query = $this->db->get('grupos_bandejas_perfiles');

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
    
    //Public method to obtain the profiles asociated by id_group
    public function obtener_perfiles_id($id_group) {
		$this->db->where('grupo_bandeja_id =', $id_group);
        $query = $this->db->get('grupos_bandejas_perfiles');

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
    
    //Public method to obtain the profiles asociated by group_id and profile_id
    public function obtener_perfil_ids($id_group, $id_perfil) {
		$this->db->where('grupo_bandeja_id =', $id_group);
		$this->db->where('perfil_id =', $id_perfil);
        $query = $this->db->get('grupos_bandejas_perfiles');

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }

    // Public method to insert the data
    public function insert($datos) {
        $result = $this->db->where('nombre =', $datos['nombre']);
        $result = $this->db->get('grupos_bandejas');
        if ($result->num_rows() > 0) {
            return 'existe';
        } else {
            $result = $this->db->insert("grupos_bandejas", $datos);
            $id = $this->db->insert_id();
            return $id;
        }
    }

    // Public method to insert the profiles asociated
    public function insert_perfil($datos) {
		$result = $this->db->insert("grupos_bandejas_perfiles", $datos);
    }

    // Public method to obtain the grupos_bandejas by id
    public function obtenerGrupo($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('grupos_bandejas');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }

    // Public method to obtain the grupos_bandejas by id
    public function perfilesGrupo($id_grupo) {
        $this->db->where('grupo_bandeja_id', $id_grupo);
        $query = $this->db->get('grupos_bandejas_perfiles');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }

    // Public method to update a record  
    public function update($datos) {
        $result = $this->db->where('nombre =', $datos['nombre']);
        $result = $this->db->where('id !=', $datos['id']);
        $result = $this->db->get('grupos_bandejas');

        if ($result->num_rows() > 0) {
            echo '1';
        } else {
            $result = $this->db->where('id', $datos['id']);
            $result = $this->db->update('grupos_bandejas', $datos);
            return $result;
        }
    }


    // Public method to delete a record
     public function delete($id) {
        //~ $result = $this->db->where('grupo_bandeja_id =', $id);
        //~ $result = $this->db->get('grupos_bandejas_perfiles');
//~ 
        //~ if ($result->num_rows() > 0) {
            //~ echo 'existe';
        //~ } else {
			// Primero buscamos y eliminamos los perfiles asociados en la tabla 'grupos_bandejas_perfiles'
			$query_profiles = $this->obtener_perfiles_id($id);
			if(count($query_profiles) > 0){
				foreach($query_profiles as $profile){
					$delete_profile = $this->delete_profile($profile->id);
				}
			}
			// Eliminamos el grupo
            $result = $this->db->delete('grupos_bandejas', array('id' => $id));
            return $result;
        //~ }
       
    }
    
    // Public method to delete the profiles asociated 
    public function delete_profile($id) {
		$result = $this->db->delete('grupos_bandejas_perfiles', array('id' => $id));
    }
    
    // Public method to delete the profiles asociated 
    public function delete_group_profile($id_group, $id_profile) {
		$result = $this->db->delete('grupos_bandejas_perfiles', array('grupo_bandeja_id' => $id_group, 'perfil_id' => $id_profile));
    }
    

}
?>
