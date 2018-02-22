<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_grupos_bandejas extends CI_Migration
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
				"nombre" => array(
					"type" => "VARCHAR",
					"constraint" => 50
				),
				"status" => array(
					"type" => "INT",
					"constraint" => 11,
					"null" => TRUE
				),
				"d_create" => array(
					"type" => "TIMESTAMP",
					"null" => TRUE
				),
				"d_update" => array(
					"type" => "TIMESTAMP",
					"null" => TRUE
				),
			)
		);
		
		$this->dbforge->add_key('id', TRUE);  // Establecemos el id como primary_key
		
		$this->dbforge->create_table('grupos_bandejas', TRUE);
		
	}
	
	public function down(){
		
		// Eliminamos la tabla 'grupos_bandejas'
		$this->dbforge->drop_table('grupos_bandejas', TRUE);
		
	}
	
}
