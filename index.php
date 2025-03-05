<?php

require_once './helpers/helpers.php';
require_once './config/config.php';
require_once './core/Autoload.php';

// Inicializamos el enrutador
$router = new Router();

// Definimos las rutas
$router->get('/', 'DemoController@index');
$router->get('/error', 'ErrorController@error');
$router->get('/demo', 'DemoController@demoMethod');
$router->get('/user/{id}', 'DemoController@showUser');
$router->post('/user', 'DemoController@createUser');
$router->put('/user/{id}', 'DemoController@updateUser');
$router->delete('/user/{id}', 'DemoController@deleteUser');
$router->get('/params/{id}/{webada}', 'DemoController@twoParams');

// Rutas del Login
$router->get('/login', 'LoginController@index');
$router->post('/login/iniciarSesion', 'LoginController@iniciarSesion');
$router->post('/login/cerrarSesion', 'LogoutController@cerrarSesion');

// Rutas de Pacientes
$router->get('/pacientes', 'PacientesController@index');

// Rutas de Triaje
$router->get('/triaje', 'TriajeController@index'); // Interfaz
$router->get('/triaje/obtenerTiposDocumento', 'TriajeController@obtenerTiposDocumento'); // Endpoint
$router->get('/triaje/obtenerFormasIngreso', 'TriajeController@obtenerFormasIngreso'); // Endpoint
$router->get('/triaje/obtenerMotivosIngreso', 'TriajeController@obtenerMotivosIngreso'); // Endpoint
$router->get('/triaje/obtenerPaciente/{tipoDocumento}/{nmroDocPaciente}', 'TriajeController@obtenerPaciente'); // Endpoint
$router->get('/triaje/obtenerServicios', 'TriajeController@obtenerServicios'); // Endpoint
$router->get('/triaje/obtenerMedicos/{servicio}', 'TriajeController@obtenerMedicos'); // Endpoint
$router->get('/triaje/obtenerDiagnosticoPorCodigo/{codigo}', 'TriajeController@obtenerDiagnosticoPorCodigo'); // Endpoint
$router->get('/triaje/obtenerDiagnosticoPorDescripcion/{descripcion}', 'TriajeController@obtenerDiagnosticoPorDescripcion'); // Endpoint
$router->get('/triaje/obtenerDiagnosticos', 'TriajeController@obtenerDiagnosticos'); // Endpoint
$router->get('/triaje/obtenerTiposDiagnostico', 'TriajeController@obtenerTiposDiagnostico'); // Endpoint
$router->get('/triaje/obtenerGravedades', 'TriajeController@obtenerGravedades'); // Endpoint
$router->get('/triaje/obtenerTiposFinanciamiento', 'TriajeController@obtenerTiposFinanciamiento'); // Endpoint

$router->post('/triaje/registrarTriaje', 'TriajeController@registrarTriaje'); // Endpoint

//Registrar Paciente
$router->get('/api/getPaciente', 'RegistroController@getRegistroEmergencia'); // Endpoint


// Consumo de la API del SIS
$router->get('/api-sis/consulta-sis/{tipoDocumento}/{nmroDocumento}', 'ApiController@consultarSis');

// Rutas de Reportes
$router->get('/reportes', 'ReportesController@index');

// Rutas de Usuarios
$router->get('/usuarios', 'UsuariosController@index');

// Procesar la petición
$router->run();
