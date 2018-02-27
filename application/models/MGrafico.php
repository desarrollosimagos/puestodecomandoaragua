<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MGrafico extends CI_Model {


    public function __construct() {
       
        parent::__construct();
        $this->load->database();
    }

    // Grafico operador
    public function grafico_operador()
    {
        $this->db->select("CONCAT(b.username || ' (', COUNT(a.id),')') AS name, COUNT(a.id) AS y");
        $this->db->from("time_line as a");
        $this->db->join("users AS b", "a.usuario=b.id", "inner");
        $this->db->group_by('b.id, b.username');
        $this->db->order_by('b.id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Cantidad de operadores
    public function count_operador()
    {
        $this->db->select("count(a.id) AS cantidad");
        $this->db->from("users as a");
        $query = $this->db->get();
        return $query->row();
    }

    // Grafico institucion, cada insttitucion se le asigna una serie de twt y estos se encargan de gestionarlos
    public function grafico_institucion()
    {
        $this->db->select("CONCAT(a.name || ' (', COUNT(a.id),')') AS name, COUNT(a.id) AS y");
        $this->db->from("profile as a");
        $this->db->join("bandeja_respuestas AS b", "b.perfil_id=a.id", "inner");
        $this->db->group_by('a.id, a.name');
        $this->db->order_by('a.id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Cantidad de instituciones
    public function count_institucion()
    {
        $this->db->select("count(a.id) AS cantidad");
        $this->db->from("profile as a");
        $query = $this->db->get();
        return $query->row();
    }

    // Estadisticas de Twitter por Mencion al Ciudadano Gobernador
    public function grafico_mencion()
    {
        $this->db->select("count(a.id) AS cantidad");
        $this->db->from("bandeja_respuestas as a");
        $query = $this->db->get();
        return $query->result();
    }

    // Estadisticas de Twitter por Mencion al Ciudadano Gobernador  + Etiquetas del Dia
    public function grafico_mencion_etiqueta()
    {
        $this->db->select("count(a.id) AS cantidad");
        $this->db->from("bandeja_respuestas as a");
        $this->db->like('a.text', '#');
        $query = $this->db->get();
        return $query->result();
    }

}
?>
