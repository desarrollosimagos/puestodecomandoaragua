<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_time_line extends CI_Migration
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
				"fecha" => array(
					"type" => "VARCHAR",
					"constraint" => 100,
					"null" => TRUE
				),
				"usuario" => array(
					"type" => "INT",
					"constraint" => 11
				),
				"mensaje" => array(
					"type" => "VARCHAR",
					"constraint" => 250,
					"null" => TRUE
				),
				"accion" => array(
					"type" => "VARCHAR",
					"constraint" => 200,
					"null" => TRUE
				),
				"tweet_id" => array(
					"type" => "VARCHAR",
					"constraint" => 100
				)
			)
		);
		
		$this->dbforge->add_key('id', TRUE);  // Establecemos el id como primary_key
		
		$this->dbforge->add_key('tweet_id');  // Establecemos el tweet_id como key
		
		$this->dbforge->create_table('time_line', TRUE);
		
	}
	
	public function down(){
		
		// Eliminamos la tabla 'time_line'
		$this->dbforge->drop_table('time_line', TRUE);
		
	}
	
}
