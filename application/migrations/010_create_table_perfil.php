<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_table_perfil extends CI_Migration
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
				"cedula" => array(
					"type" => "VARCHAR",
					"constraint" => 10,
					"null" => TRUE
				),
				"genero" => array(
					"type" => "VARCHAR",
					"constraint" => 20,
					"null" => TRUE
				),
				"nombre" => array(
					"type" => "VARCHAR",
					"constraint" => 50,
					"null" => TRUE
				),
				"apellido" => array(
					"type" => "VARCHAR",
					"constraint" => 50,
					"null" => TRUE
				),
				"fecha_nac" => array(
					"type" => "VARCHAR",
					"constraint" => 20,
					"null" => TRUE
				),
				"direccion_nac" => array(
					"type" => "VARCHAR",
					"constraint" => 200,
					"null" => TRUE
				),
				"direccion_viv" => array(
					"type" => "VARCHAR",
					"constraint" => 200,
					"null" => TRUE
				),
				"telefono" => array(
					"type" => "VARCHAR",
					"constraint" => 20,
					"null" => TRUE
				),
				"celular" => array(
					"type" => "VARCHAR",
					"constraint" => 20,
					"null" => TRUE
				),
				"correo" => array(
					"type" => "VARCHAR",
					"constraint" => 50,
					"null" => TRUE
				),
				"centro_votacion" => array(
					"type" => "VARCHAR",
					"constraint" => 200,
					"null" => TRUE
				),
				"direccion_centro_votacion" => array(
					"type" => "VARCHAR",
					"constraint" => 200,
					"null" => TRUE
				),
				"facebook" => array(
					"type" => "VARCHAR",
					"constraint" => 50,
					"null" => TRUE
				)
			)
		);
		
		$this->dbforge->add_key('id', TRUE);  // Establecemos el id como primary_key
		
		$this->dbforge->create_table('perfil', TRUE);
		
	}
	
	public function down(){
		
		// Eliminamos la tabla 'perfil'
		$this->dbforge->drop_table('perfil', TRUE);
		
	}
	
}
