<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('LoginController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'LoginController::index');
$routes->get('/', 'GestionController::index');
$routes->get('nuevo-alquiler', 'GestionController::nuevoAlquiler');
$routes->get('multas-credito', 'GestionController::multasCredito');
$routes->get('alquileres-concretados', 'GestionController::alquileresConcretados');
$routes->get('credito-multas-cliente', 'GestionController::creditoYMultasCliente');
$routes->get('puntos-retorno', 'GestionController::puntosRetorno');
$routes->get('horarios-mayor-demanda', 'GestionController::horarioMayorDemanda');
$routes->get('tiempo-alquiler', 'GestionController::tiempoAlquiler');
$routes->get('calificar-punto-ed', 'GestionController::calificarPuntoED');
$routes->get('buscar-punto-ed', 'GestionController::buscarPuntoED');
//$routes->get('horario-mayor-demanda', 'AlquilerController::mostrarPDF');
//$routes->get('horario-mayor-demanda', 'AlquilerController::generaPuntosPDF');
$routes->get('alta-bicicleta', 'GestionController::altaBicicleta');
$routes->get('modificar-bicicleta', 'GestionController::modificarBicicleta');
$routes->get('baja-bicicleta', 'GestionController::bajaBicicleta');
//*************RUTA DE ALQUILER CONTROLLER******************
$routes->post('alquiler-nuevo', 'AlquilerController::solicitarAlquiler');
$routes->post('alquiler-asignado', 'GestionController::alquilerAsignado');
$routes->get('confirmar-alquiler', 'AlquilerController::soliticaConfirmarAlquiler');
$routes->get('datos-confirmar-alquiler', 'AlquilerController::cargarDatosConfirmarAlquiler');
$routes->get('datos-anular-alquiler', 'AlquilerController::cargarDatosConfirmarAlquiler');
$routes->get('datos-reportar-alquiler', 'AlquilerController::cargarDatosConfirmarAlquiler');
$routes->get('hay-alquiler-nuevo', 'AlquilerController::hayAlquiler');

//*************RUTA DE USUARIO CONTROLLER******************
$routes->post('cliente-alternativo', 'UsuarioController::buscarClienteAlternativo');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}