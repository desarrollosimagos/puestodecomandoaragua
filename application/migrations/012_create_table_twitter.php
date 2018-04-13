<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_twitter extends CI_Migration
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
					"constraint" => 100,
					"null" => TRUE
				),
				"name" => array(
					"type" => "VARCHAR",
					"constraint" => 100,
					"null" => TRUE
				),
				"location" => array(
					"type" => "VARCHAR",
					"constraint" => 200,
					"null" => TRUE
				),
				"url" => array(
					"type" => "VARCHAR",
					"constraint" => 200,
					"null" => TRUE
				),
				"description" => array(
					"type" => "VARCHAR",
					"constraint" => 250,
					"null" => TRUE
				),
				"followers_count" => array(
					"type" => "INT",
					"constraint" => 11,
					"null" => TRUE
				),
				"friends_count" => array(
					"type" => "INT",
					"constraint" => 11,
					"null" => TRUE
				),
				"listed_count" => array(
					"type" => "INT",
					"constraint" => 11,
					"null" => TRUE
				),
				"favorites_count" => array(
					"type" => "INT",
					"constraint" => 11,
					"null" => TRUE
				),
				"statuses_count" => array(
					"type" => "INT",
					"constraint" => 11,
					"null" => TRUE
				),
				"profile_image_url" => array(
					"type" => "VARCHAR",
					"constraint" => 100,
					"null" => TRUE
				)
			)
		);
		
		$this->dbforge->add_key('id', TRUE);  // Establecemos el id como primary_key
		
		$this->dbforge->create_table('twitter', TRUE);
		
	}
	
	public function down(){
		
		// Eliminamos la tabla 'twitter'
		$this->dbforge->drop_table('twitter', TRUE);
		
	}
	
}
