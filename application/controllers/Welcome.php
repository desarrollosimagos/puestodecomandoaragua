<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        parent::__construct();
        
		// Load database
        $this->load->model('MServices');
        $this->load->model('MOrder');
        $this->load->model('MClient');
        $this->load->model('MServices');
        $this->load->model('MProduct');
        $this->load->model('MUser');
        $this->load->model('MPerfil');
        $this->load->model('MAcciones');
        $this->load->model('MMenus');
        $this->load->model('MSubMenus');
        $this->load->model('MGruposBandejas');
        //~ $this->load->model('MFranchises');
    }
	 
	public function index()
	{
		// Validamos la base de datos
		$exists = $this->exists_database();
		if($exists == "existe"){
			
			$this->migrations();  // Ejecutamos las migraciones
			
		}
		
		// Cargamos la plantilla base
		$this->load->view('login_form');
	}
	
	public function admin()
	{
		$this->load->view('login_form');
	}
	
	public function somos()
	{
		$data['pagina'] = 'somos.php';
		$data['section'] = 'somos';
		$this->load->view('base_public', $data);
	}
	
	public function servicios()
	{
		$data['pagina'] = 'servicios.php';
		$data['section'] = 'servicios';
		$data['servicios'] = $this->MServices->obtener();
		$this->load->view('base_public', $data);
	}
	
	public function solicitud()
	{
		$data['pagina'] = 'solicitud.php';
		$data['section'] = 'solicitud';
		$data['direcciones'] = array();
        $data['vehiculos'] = array();
        $data['franquicias'] = $this->MFranchises->obtener();
        $data['servicios'] = $this->MServices->obtener();
		//Armamos la lista de direcciones asociadas
		if(isset($this->session->userdata['logged_in_public'])){
			$query_addresses = $this->db->get_where('addresses', array('customer_id'=>$this->session->userdata['logged_in_public']['id']));
			if($query_addresses->num_rows() > 0){
				foreach($query_addresses->result() as $address){
					$data['direcciones'][] = $address;
				}
			}
		}
		//Armamos la lista de vehículos asociados
		if(isset($this->session->userdata['logged_in_public'])){
			$query_vehicles = $this->db->get_where('vehicles', array('customer_id'=>$this->session->userdata['logged_in_public']['id']));
			if($query_vehicles->num_rows() > 0){
				foreach($query_vehicles->result() as $vehicle){
					$data['vehiculos'][] = $vehicle;
				}
			}
		}
		
		$this->load->view('base_public', $data);
	}
	
	public function noticias()
	{
		$data['pagina'] = 'noticias.php';
		$data['section'] = 'noticias';
		$this->load->view('base_public', $data);
	}
	
	public function contacto()
	{
		$data['pagina'] = 'contacto.php';
		$data['section'] = 'contacto';
		$this->load->view('base_public', $data);
	}
	
	public function public_perfil()
	{
		$data['pagina'] = 'public_perfil.php';
		$data['section'] = 'public';
        $data['list_orders_services'] = $this->MOrder->getServices();
        $data['list_orders_products'] = $this->MOrder->getProducts();
        $data['list_serv'] = $this->MServices->obtener();
        $data['list_prod'] = $this->MProduct->obtener();
        $data['list_franq'] = $this->MFranchises->obtener();
        $data['list_client'] = $this->MClient->obtener();
        $data['status'] = $this->MOrder->obtenerStatus();
        $data['direcciones'] = array();
        $data['vehiculos'] = array();
        $data['ordenes'] = array();
		
		//Armamos la lista de ordenes asociados
		$query_orders = $this->db->get_where('orders', array('customer_id'=>$this->session->userdata['logged_in_public']['id']));
		if($query_orders->num_rows() > 0){
			foreach($query_orders->result() as $order){
				$data['ordenes'][] = $order;
			}
		}
		//Armamos la lista de direcciones asociadas
		$query_addresses = $this->db->get_where('addresses', array('customer_id'=>$this->session->userdata['logged_in_public']['id']));
		if($query_addresses->num_rows() > 0){
			foreach($query_addresses->result() as $address){
				$data['direcciones'][] = $address;
			}
		}
		//Armamos la lista de vehículos asociados
		$query_vehicles = $this->db->get_where('vehicles', array('customer_id'=>$this->session->userdata['logged_in_public']['id']));
		if($query_vehicles->num_rows() > 0){
			foreach($query_vehicles->result() as $vehicle){
				$data['vehiculos'][] = $vehicle;
			}
		}
		$this->load->view('base_public', $data);
	}
	
	
    // Método para verificar si la base de datos existe
    public function exists_database(){
		
		$this->load->dbutil();
		
		if ($this->dbutil->database_exists('twitter'))
		{
			
			return "existe";
			
		}else{
			
			return "no existe";
			
		}
		
	}
	
	// Método que realiza las migraciones correspondientes
	public function migrations(){
		
		// Carga de la librería
		$this->load->library('migration');
		
		// Ejecutamos la migración
		if(!$this->migration->latest()){
			
			echo "error";
			show_error($this->migration->error_string());
			
		}else{
		
			//echo "success";
			
			// Precarga de datos necesarios
			
			// Verificamos si existe la tabla de usuarios 'users'
			$exists_users = $this->db->table_exists('users');
			
			if($exists_users){
				
				$usuario = $this->MUser->obtener();
				// Creamos el usuario admin si éste no existe
				if(count($usuario) == 0){
					
					$data_admin = array(
						'username' => 'admin@gmail.com',
						'name' => 'admin',
						'lastname' => 'admin',
						'profile_id' => 1,
						'admin' => 1,
						'password' => 'pbkdf2_sha256$12000$a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3',
						'status' => 1,
						'd_create' => date('Y-m-d H:i:s'),
						'd_update' => date('Y-m-d H:i:s')
					);
					
					$insert_admin = $this->MUser->insert($data_admin);
					
				}
				
			}
			
			// Verificamos si existe la tabla de perfiles 'profile'
			$exists_profile = $this->db->table_exists('profile');
			
			if($exists_profile){
			
				$perfil = $this->MPerfil->obtener();
				// Creamos el perfil ADMINISTRADOR si éste no existe
				if(count($perfil) == 0){
				
					$data_administrador = array(
						'name' => 'ADMINISTRADOR',
						'd_create' => date('Y-m-d H:i:s'),
						'd_update' => date('Y-m-d H:i:s')
					);
					
					$insert_administrador = $this->MPerfil->insert($data_administrador);
				
				}
			
			}
			
			// Verificamos si existe la tabla de acciones 'actions'
			$exists_actions = $this->db->table_exists('actions');
			
			if($exists_actions){
			
				$accion = $this->MAcciones->obtener();
				// Creamos la acción HOME si ésta no existe
				if(count($accion) == 0){
				
					// Importamos las acciones básicas
					$this->import_actions();
					
					// Asociamos la acción 1 (HOME) al perfil 1 (ADMINISTRADOR)
					$data_assoc = array(
						'profile_id' => 1,
						'action_id' => 1,
						'parameter_permit' => '777',
						'd_create' => date('Y-m-d H:i:s'),
						'd_update' => date('Y-m-d H:i:s')
					);
					
					$insert_assoc = $this->MPerfil->insert_action($data_assoc);
					
					// Asociamos las acciones diferentes a 1 (HOME) al usuario 1 (admin@gmail.com).
					// Primero verificamos si existe la tabla 'permissions'
					$exists_permissions = $this->db->table_exists('permissions');
					
					if($exists_permissions){
						
						// Listamos las acciones
						$acciones = $this->MAcciones->obtener();
						
						if(count($acciones) > 0){
							
							foreach($acciones as $accion){
								
								if($accion->id != 1){
									
									$data_assoc2 = array(
										'user_id' => 1,
										'action_id' => $accion->id,
										'parameter_permit' => '777',
										'd_create' => date('Y-m-d H:i:s'),
										'd_update' => date('Y-m-d H:i:s')
									);
									
									$insert_assoc2 = $this->MUser->insert_action($data_assoc2);
									
								}
								
							}
							
						}
						
					}
				
				}
			
			}
			
			// Verificamos si existe la tabla de menús 'menus'
			$exists_menus = $this->db->table_exists('menus');
			
			if($exists_menus){
			
				$menu = $this->MMenus->obtener();
				// Creamos los menús básicos si éstos no existen
				if(count($menu) == 0){
					
					// Importamos los menús básicos
					$this->import_menus();
				
				}
			
			}
			
			// Verificamos si existe la tabla de submenús 'submenus'
			$exists_submenus = $this->db->table_exists('submenus');
			
			if($exists_submenus){
			
				$submenu = $this->MSubMenus->obtener();
				// Creamos los submenús básicos si éstos no existen
				if(count($submenu) == 0){
					
					// Importamos los submenús básicos
					$this->import_submenus();
				
				}
			
			}
			
			// Verificamos si existe la tabla de íconos 'icons'
			$exists_icons = $this->db->table_exists('icons');
			
			if($exists_icons){
			
				$icono = $this->MMenus->search_icons();
				// Creamos los íconos básicos si éstos no existen
				if($icono == 0){
					
					// Importamos los íconos básicos
					$this->import_icons();
				
				}
			
			}
			
			// Verificamos si existe la tabla de grupos de bandejas 'grupos_bandejas'
			$exists_groups = $this->db->table_exists('grupos_bandejas');
			
			if($exists_groups){
			
				$group = $this->MGruposBandejas->obtener();
				// Creamos los grupos básicos si éstos no existen ('Político' y 'Asistencial')
				if(count($group) == 0){
					
					// Importamos los grupos básicos
					$this->import_grupos();
				
				}
			
			}
		
		}
		
	}
	
	// Método que importa las acciones básicas desde un csv
    public function import_actions() {
        
        $ruta = getcwd();  // Obtiene el directorio actual en donde se está trabajando
        
        $fp = fopen ($ruta."/application/migrations/actions.csv","r");
        
        while ($data = fgetcsv ($fp, 1000, ",")) {
			
			$data_accion2 = array(
				'name' => $data[1],
				'class' => $data[2],
				'route' => $data[3],
				'assigned' => $data[4],
				'd_create' => date('Y-m-d H:i:s'),
				'd_update' => date('Y-m-d H:i:s')
			);
			
			$insert_accion = $this->MAcciones->insert($data_accion2);
			
		}
		
		fclose ($fp);
        
    }
    
    // Método que importa los menús básicos desde un csv
    public function import_menus() {
        
        $ruta = getcwd();  // Obtiene el directorio actual en donde se está trabajando
        
        $fp = fopen ($ruta."/application/migrations/menus.csv","r");
        
        while ($data = fgetcsv ($fp, 1000, ",")) {
			
			$data_menu = array(
				'name' => $data[1],
				'description' => $data[2],
				'logo' => $data[3],
				'route' => $data[4],
				'action_id' => $data[5],
				'd_create' => date('Y-m-d H:i:s'),
				'd_update' => date('Y-m-d H:i:s')
			);
			
			$insert_menu = $this->MMenus->insert($data_menu);
			
		}
		
		fclose ($fp);
        
    }
    
    // Método que importa los submenús básicos desde un csv
    public function import_submenus() {
        
        $ruta = getcwd();  // Obtiene el directorio actual en donde se está trabajando
        
        $fp = fopen ($ruta."/application/migrations/submenus.csv","r");
        
        while ($data = fgetcsv ($fp, 1000, ",")) {
			
			$data_submenu = array(
				'name' => $data[1],
				'description' => $data[2],
				'logo' => $data[3],
				'route' => $data[4],
				'menu_id' => $data[5],
				'action_id' => $data[6],
				'd_create' => date('Y-m-d H:i:s'),
				'd_update' => date('Y-m-d H:i:s')
			);
			
			$insert_submenu = $this->MSubMenus->insert($data_submenu);
			
		}
		
		fclose ($fp);
        
    }
    
    // Método que importa los iconos desde un csv
    public function import_icons() {
        
        $ruta = getcwd();  // Obtiene el directorio actual en donde se está trabajando
        
        $fp = fopen ($ruta."/application/migrations/icons.csv","r");
        
        while ($data = fgetcsv ($fp, 1000, ",")) {
			
			$data_icon = array(
				'class' => $data[1],
				'name' => $data[2],
				'category' => $data[3],
				'd_create' => date('Y-m-d H:i:s'),
				'd_update' => date('Y-m-d H:i:s')
			);
			
			$insert_icon = $this->MMenus->insert_icons($data_icon);
			
		}
		
		fclose ($fp);
        
    }
    
    // Método que importa los grupos de bandejas desde un csv
    public function import_grupos() {
        
        $ruta = getcwd();  // Obtiene el directorio actual en donde se está trabajando
        
        $fp = fopen ($ruta."/application/migrations/grupos_bandejas.csv","r");
        
        while ($data = fgetcsv ($fp, 1000, ",")) {
			
			$data_group = array(
				'nombre' => $data[1],
				'status' => $data[2],
				'd_create' => date('Y-m-d H:i:s'),
				'd_update' => date('Y-m-d H:i:s')
			);
			
			$insert_group = $this->MGruposBandejas->insert($data_group);
			
		}
		
		fclose ($fp);
        
    }
	
}
