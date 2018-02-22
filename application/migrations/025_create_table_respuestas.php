<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_respuestas extends CI_Migration
{
	public function up(){
		
		// Creamos la estructura de la nueva tabla usando la clase dbforge de Codeigniter
		$this->dbforge->add_field(
			array(
				"id" => array(
					"type" => "INT",
					"constraint" => 11,
					"unsigned" => TRUE,
					"auto_increment" => TRUE,
					"null" => FALSE
				),
				"screen_name" => array(
					"type" => "VARCHAR",
					"constraint" => 100
				),
				"id_str" => array(
					"type" => "VARCHAR",
					"constraint" => 100
				),
				"text" => array(
					"type" => "VARCHAR",
					"constraint" => 300,
					"null" => TRUE
				),
				"created_at" => array(
					"type" => "VARCHAR",
					"constraint" => 100,
					"null" => TRUE
				),
				"asignacion" => array(
					"type" => "VARCHAR",
					"constraint" => 100,
					"null" => TRUE
				),
				"bot" => array(
					"type" => "INT",
					"constraint" => 11,
					"null" => TRUE
				),
				"status" => array(
					"type" => "INT",
					"constraint" => 11,
					"null" => TRUE
				),
				"perfil_id" => array(
					"type" => "INT",
					"constraint" => 11,
					"null" => TRUE
				)
			)
		);
		
		$this->dbforge->add_key('id', TRUE);  // Establecemos el id como primary_key
		
		$this->dbforge->add_key('id_str');  // Establecemos el id_str como key
		
		$this->dbforge->add_key('perfil_id');  // Establecemos el perfil_id como key
		
		$this->dbforge->create_table('bandeja_respuestas', TRUE);
		
	}
	
	public function down(){
		
		// Eliminamos la tabla 'bandeja_respuestas'
		$this->dbforge->drop_table('bandeja_respuestas', TRUE);
		
	}
	
}
