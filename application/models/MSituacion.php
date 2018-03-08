<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MSituacion extends CI_Model {


    public function __construct() {
       
        parent::__construct();
        $this->load->database();
    }

    //Public method to obtain the profile
    public function obtener() {
        $query = $this->db->get('situacion');
        return $query->result();
    }

    // Public method to insert the data
    public function add($datos) {
        $result = $this->db->where('name =', $datos['name']);
        $result = $this->db->get('situacion');
        if ($result->num_rows() > 0) {
            return 'existe';
        } else {
            $result = $this->db->insert("situacion", $datos);
            $id = $this->db->insert_id();
            return $id;
        }
    }

    // Public method to obtain the users by id
    public function obtenerSituacion($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('situacion');
        return $query->row();
    }

    // Public method to obtain the users by id
    public function obtenerSituacionName($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('situacion');
        return $query->row();
    }

    // Public method to update a record 
    public function update($datos) {
        $result = $this->db->where('name =', $datos['name']);
        $result = $this->db->where('id !=', $datos['id']);
        $result = $this->db->get('situacion');

        if ($result->num_rows() > 0) {
            return 'existe';
        } else {
            $result = $this->db->where('id', $datos['id']);
            $result = $this->db->update('situacion', $datos);
            return $result;
        }
    }

    // Public method to delete a record
     public function delete($id) {
        return $this->db->delete('situacion', array('id' => $id));
    }

    // Public method to obtain the users by id
    public function ajax_situacion($name) {
        $this->db->like('name', $name);
        $this->db->select('name');
        $query = $this->db->get('situacion');
        $results = array();
        foreach ($query->result() as $row){
            $results[] = $row->name;

        }
        return $results;
    }
}
?>
