<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'CLogin/login/';
$route['login_public'] = 'CLogin/login_public/';
$route['logout'] = 'CLogin/logout/';
$route['logout_public'] = 'CLogin/logout_public/';
//$route['home'] = 'Home/home/';
$route['admin'] = 'Welcome/admin/';
/* page public*/
$route['public'] = 'welcome';
$route['public_perfil'] = 'welcome/public_perfil';
$route['somos'] = 'welcome/somos';
$route['servicios'] = 'welcome/servicios';
$route['solicitud'] = 'welcome/solicitud';
$route['noticias'] = 'welcome/noticias';
//~ $route['cuenta'] = 'welcome/cuenta';
$route['contacto'] = 'welcome/contacto';
$route['send_message'] = 'CMessages/add_message';

/* Perfiles */
$route['profile'] = 'CPerfil';
$route['profile_register'] = 'CPerfil/register';
$route['profile_edit/(:num)'] = 'CPerfil/edit/$1';
$route['profile_delete/(:num)'] = 'CPerfil/delete/$1';
/*   Users */
$route['users'] = 'CUser';
$route['users_register'] = 'CUser/register';
$route['users_edit/(:num)'] = 'CUser/edit/$1';

/* Situacion */
$route['situacion'] = 'CSituacion';
$route['situacion_register'] = 'CSituacion/register';
$route['situacion_edit/(:num)'] = 'CSituacion/edit/$1';
$route['situacion_delete/(:num)'] = 'CSituacion/delete/$1';
$route['situacion_mensiones_json'] = 'CSituacion/ajax_situacion';

/*   Menús */
$route['menus'] = 'CMenus';
$route['menus/register'] = 'CMenus/register';
$route['menus/edit/(:num)'] = 'CMenus/edit/$1';
$route['menus/delete/(:num)'] = 'CMenus/delete/$1';
/*   Submenús */
$route['submenus'] = 'CSubMenus';
$route['submenus/register'] = 'CSubMenus/register';
$route['submenus/edit/(:num)'] = 'CSubMenus/edit/$1';
$route['submenus/delete/(:num)'] = 'CSubMenus/delete/$1';
/*   Acciones */
$route['acciones'] = 'CAcciones';
$route['acciones/register'] = 'CAcciones/register';
$route['acciones/edit/(:num)'] = 'CAcciones/edit/$1';
$route['acciones/delete/(:num)'] = 'CAcciones/delete/$1';
/*   Productos */
$route['productos'] = 'CProductos/index2';
$route['productos_json'] = 'CProductos/ajax_productos';
$route['productos_json2'] = 'CProductos/ajax_productos2';
$route['productos_json3'] = 'CProductos/ajax_productos3';
$route['productos_json4'] = 'CProductos/ajax_productos4';
$route['productos/register'] = 'CProductos/register';
$route['productos/edit/(:num)'] = 'CProductos/edit/$1';
$route['productos/delete/(:num)'] = 'CProductos/delete/$1';
/*   Grupos Bandejas */
$route['grupos_bandejas'] = 'CGruposBandejas';
$route['grupos_bandejas/register'] = 'CGruposBandejas/register';
$route['grupos_bandejas/edit/(:num)'] = 'CGruposBandejas/edit/$1';
$route['grupos_bandejas/delete/(:num)'] = 'CGruposBandejas/delete/$1';

/*   Bandeja de entrada */
$route['bandeja_entrada'] = 'CBandejaEntrada/index';
$route['entrada_json'] = 'CBandejaEntrada/ajax_entrada';
$route['entrada/cambiar_bandeja'] = 'CBandejaEntrada/cambio_bandeja';

/*   Bandeja política */
$route['bandeja_politico'] = 'CBandejaPolitico/index';
$route['politico_json'] = 'CBandejaPolitico/ajax_politico';
$route['politico/cambiar_bandeja'] = 'CBandejaPolitico/cambio_bandeja';
/*   Bandeja de operantes */
$route['bandeja_operantes'] = 'CBandejaOperantes/index';
$route['operantes_json'] = 'CBandejaOperantes/ajax_operantes';
$route['operantes/cambiar_bandeja'] = 'CBandejaOperantes/cambio_bandeja';
/*   Bandeja de oponentes */
$route['bandeja_oponentes'] = 'CBandejaOponentes/index';
$route['oponentes_json'] = 'CBandejaOponentes/ajax_oponentes';
$route['oponentes/cambiar_bandeja'] = 'CBandejaOponentes/cambio_bandeja';

/*   Bandeja asistencial */
$route['bandeja_asistencial'] = 'CBandejaAsistencial/index';
$route['asistencial_json'] = 'CBandejaAsistencial/ajax_asistencial';
$route['asistencial/cambiar_bandeja'] = 'CBandejaAsistencial/cambio_bandeja';
/*   Bandeja de individuales */
$route['bandeja_individuales'] = 'CBandejaIndividuales/index';
$route['individuales_json'] = 'CBandejaIndividuales/ajax_individuales';
$route['individuales/cambiar_bandeja'] = 'CBandejaIndividuales/cambio_bandeja';
/*   Bandeja de colectivos */
$route['bandeja_colectivos'] = 'CBandejaColectivos/index';
$route['colectivos_json'] = 'CBandejaColectivos/ajax_colectivos';
$route['colectivos/cambiar_bandeja'] = 'CBandejaColectivos/cambio_bandeja';

/*   Bandeja de respuestas */
$route['bandeja_respuestas'] = 'CBandejaRespuestas/index';
$route['respuestas_json'] = 'CBandejaRespuestas/ajax_respuestas';
$route['respuestas/cambiar_bandeja'] = 'CBandejaRespuestas/cambio_bandeja';

/*   Bandeja de resueltos */
$route['bandeja_resueltos'] = 'CBandejaResueltos/index';
$route['resueltos_json'] = 'CBandejaResueltos/ajax_resueltos';

/*   Bandeja de observaciones */
$route['bandeja_observaciones'] = 'CBandejaObservaciones/index';
$route['observaciones_json'] = 'CBandejaObservaciones/ajax_observaciones';
$route['observaciones/cambiar_bandeja'] = 'CBandejaObservaciones/cambio_bandeja';
$route['observaciones/eliminar'] = 'CBandejaObservaciones/eliminar';

/*   Perfil de Twitter */
$route['twitters'] = 'CTwitter/index';
$route['twitters_json'] = 'CTwitter/ajax_twitters';
$route['twitters/view'] = 'CTwitter/view';
$route['twitters/time_line'] = 'CTwitter/time_line';

/*   Time-line de Tweets */
$route['time_line'] = 'CTweet/index';
$route['time_line/time_line'] = 'CTweet/time_line';

/*   Perfiles Sociales */
$route['social_profile'] = 'CPerfilSocial';
$route['social_profile/register'] = 'CPerfilSocial/register';
$route['social_profile/ver'] = 'CPerfilSocial/ver';
$route['social_profile/edit'] = 'CPerfilSocial/edit';
$route['social_profile/associate'] = 'CPerfilSocial/associate';

/*   Graficos  */
$route['home'] = 'Home/home/';
$route['observacion'] = 'CGrafico';
$route['operador_json'] = 'CGrafico/grafico_operador';
$route['institucion_json'] = 'CGrafico/grafico_institucion';
$route['institucion_situacion_json'] = 'CGrafico/grafico_institucion_situacion';
$route['mencion_json'] = 'CGrafico/grafico_mencion';
$route['mencion_etiqueta_json'] = 'CGrafico/grafico_mencion_etiqueta';


/*   Migraciones */
$route['migrar'] = 'CMigrations';

/*assets*/
$route['assets/(:any)'] = 'assets/$1';

// Pruebas
$route['enviar_mail'] = 'CPruebas/enviar_mail';
