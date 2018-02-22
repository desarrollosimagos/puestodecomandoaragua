<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_twitter_perfil extends CI_Migration
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
				"perfil_id" => array(
					"type" => "INT",
					"constraint" => 11,
					"null" => TRUE
				),
				"twitter_id" => array(
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
				)
			)
		);
		
		$this->dbforge->add_key('id', TRUE);  // Establecemos el id como primary_key
		
		$this->dbforge->add_key('perfil_id');  // Establecemos el perfil_id como key
		
		$this->dbforge->add_key('twitter_id');  // Establecemos el twitter_id como key
		
		$this->dbforge->create_table('twitter_perfil', TRUE);
		
	}
	
	public function down(){
		
		// Eliminamos la tabla 'twitter_perfil'
		$this->dbforge->drop_table('twitter_perfil', TRUE);
		
	}
	
}
