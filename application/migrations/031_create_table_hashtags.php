<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_hashtags extends CI_Migration
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
				"name" => array(
					"type" => "VARCHAR",
					"constraint" => 15
				),
				"d_create" => array(
					"type" => "DATE",
					"null" => TRUE
				),
			)
		);
		
		$this->dbforge->add_key('id', TRUE);  // Establecemos el id como primary_key		
		$this->dbforge->create_table('hashtags', TRUE);
		
	}
	
	public function down(){
		
		// Eliminamos la tabla 'time_line_situacion'
		$this->dbforge->drop_table('hashtags', TRUE);
		
	}
	
}