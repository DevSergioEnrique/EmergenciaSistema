<?php

    class ReportesController extends Controller {

        protected $reportesService;

        public function __construct() {
            // Iniciar sesión solo si no está iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            // $this->reportesService = $this->getService("ReportesService");
        
            // Si no está logueado, lo mandamos a login (evita que ingrese sin logueo)
            if (!isset($_SESSION['Usuario']) && empty($_SESSION['Usuario'])) {
                header('Location: ' . APP_URL . '/login');
                exit();
            }    
        }

        // Método de acción para cargar la vista
        public function index() {
            $data = [
                'title' => 'Pacientes',
                'content' => 'Bienvenido a nuestra página de inicio.'
            ];

            $this->getView('Reportes/generarReportes', $data);
        }
    }
