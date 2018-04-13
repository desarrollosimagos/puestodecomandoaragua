<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CGruposBandejas extends CI_Controller {

	public function __construct() {
        parent::__construct();


       
		// Load database
        $this->load->model('MGruposBandejas');
        $this->load->model('MPerfil');
		
    }
	
	public function index()
	{
		$this->load->view('base');
		$data['listar'] = $this->MGruposBandejas->obtener();
		$data['grupos_bandejas_perfiles'] = $this->MGruposBandejas->obtener_perfiles();
		$data['perfiles'] = $this->MPerfil->obtener();
		$this->load->view('grupos_bandejas/lista', $data);
		$this->load->view('footer');
	}
	
	public function register()
	{
		$this->load->view('base');
		$data['perfiles'] = $this->MPerfil->obtener();
		$this->load->view('grupos_bandejas/registrar', $data);
		$this->load->view('footer');
	}
	
	// Método para guardar un nuevo registro
    public function add() {
		
		$datos = array(
            'nombre' => $this->input->post('nombre'),
            'status' => $this->input->post('status'),
        );
        
        $result = $this->MGruposBandejas->insert($datos);
        
        echo $result;
        
        if ($result != 'existe') {
			// Proceso de registro de perfiles asociados al grupo
			// Asociamos los perfiles seleccionadas del combo select
			foreach($this->input->post('perfiles_ids') as $perfil_id){
				$data_perfil = array('grupo_bandeja_id'=>$result, 'perfil_id'=>$perfil_id);
				$this->MGruposBandejas->insert_perfil($data_perfil);
			}
        }else{
			return $result;
		}
        
    }
	
	// Método para editar
    public function edit() {
		
		$this->load->view('base');
        $data['id'] = $this->uri->segment(3);
        $data['perfiles'] = $this->MPerfil->obtener();
        $perfiles_grupo = $this->MGruposBandejas->perfilesGrupo($data['id']);  // Perfiles asociados al grupo
        // Armamos una cadena separada por comas con los ids de los perfiles asociados al grupo
        $ids_perfiles = "";
        if(count($perfiles_grupo) > 0){
			foreach($perfiles_grupo as $perfil){
				$ids_perfiles .= $perfil->perfil_id.",";
			}
		}
		$ids_perfiles = substr($ids_perfiles, 0, -1);
        $data['ids_perfiles'] = $ids_perfiles;
        $data['editar'] = $this->MGruposBandejas->obtenerGrupo($data['id']);
        $this->load->view('grupos_bandejas/editar', $data);
		$this->load->view('footer');
    }
	
	// Método para actualizar
    public function update() {
		
		$datos = array(
			'id' => $this->input->post('id'),
			'nombre' => $this->input->post('nombre'),
			'status' => $this->input->post('status'),
		);
		
        $result = $this->MGruposBandejas->update($datos);
        
        if($result){
			
			// Proceso de registro de perfiles asociados al grupo
			$ids_perfiles = array(); // Aquí almacenaremos los ids de los perfiles a asociar
			// Asociamos los nuevos perfiles seleccionados del combo select
			foreach($this->input->post('perfiles_ids') as $perfil_id){
				// Primero verificamos si ya está asociado cada perfil, si no lo está, lo insertamos
				$check_associated = $this->MGruposBandejas->obtener_perfil_ids($datos['id'], $perfil_id);
				//~ echo count($check_associated);
				if(count($check_associated) == 0){
					$data_perfil = array('grupo_bandeja_id'=>$datos['id'], 'perfil_id'=>$perfil_id);
					$this->MGruposBandejas->insert_perfil($data_perfil);
				}
				// Vamos colectando los ids recorridos
				$ids_perfiles[] = $perfil_id;
			}
			
			// Validamos qué perfiles han sido quitados del combo select para proceder a borrar las relaciones
			// Primero buscamos todos los perfiles asociados al grupo
			$query_associated = $this->MGruposBandejas->obtener_perfiles_id($datos['id']);
			if(count($query_associated) > 0){
				// Verificamos cuáles de los perfiles no están en la nueva lista
				foreach($query_associated as $association){
					if(!in_array($association->perfil_id, $ids_perfiles)){
						// Eliminamos la asociacion de la tabla grupos_bandejas_perfiles
						$this->MGruposBandejas->delete_group_profile($datos['id'], $association->perfil_id);
					}
				}
			}
		
		}
        
    }
    
	// Método para eliminar
	function delete($id) {
		
        $result = $this->MGruposBandejas->delete($id);
        if ($result) {
          /*  $this->libreria->generateActivity('Eliminado País', $this->session->userdata['logged_in']['id']);*/
        }
    }
	
	public function ajax_service()
    {                                          #Campo         #Tabla                #ID
        $result = $this->MGruposBandejas->obtener();
        echo json_encode($result);
    }
	
	
}
