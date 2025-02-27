<?php

    class TriajeController extends Controller {

        protected $triajeService;

        public function __construct() {
            // Iniciar sesión solo si no está iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            $this->triajeService = $this->getService("triajeService");
        
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

            $this->getView('Triaje/registrarTriaje', $data);
        }

        public function obtenerTokenAPI(){
            try {
                $tokenAPI = $this->triajeService->obtenerTokenAPI();
                echo json_encode($tokenAPI, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function obtenerTiposDocumento() {
            try {
                $tiposDocumento = $this->triajeService->obtenerTiposDocumento();
                echo json_encode($tiposDocumento, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function obtenerFormasIngreso() {
            try {
                $formasIngreso = $this->triajeService->obtenerFormasIngreso();
                echo json_encode($formasIngreso, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function obtenerMotivosIngreso() {
            try {
                $motivosIngreso = $this->triajeService->obtenerMotivosIngreso();
                echo json_encode($motivosIngreso, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function obtenerPaciente($tipoDocumento, $nmroDocPaciente) {
            try {
                $paciente = $this->triajeService->obtenerPaciente($tipoDocumento, $nmroDocPaciente);
                echo json_encode($paciente, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function obtenerServicios() {
            try {
                $servicios = $this->triajeService->obtenerServicios();
                echo json_encode($servicios, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function obtenerMedicos($idServicio) {
            try {
                $medicos = $this->triajeService->obtenerMedicos($idServicio);
                echo json_encode($medicos, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function obtenerDiagnosticos() {
            try {
                $diagnostico = $this->triajeService->obtenerDiagnosticos();
                echo json_encode($diagnostico, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function obtenerDiagnosticoPorCodigo($codigo) {
            try {
                $diagnostico = $this->triajeService->obtenerDiagnosticoPorCodigo($codigo);
                echo json_encode($diagnostico, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function obtenerDiagnosticoPorDescripcion($descripcion) {
            try {
                $diagnostico = $this->triajeService->obtenerDiagnosticoPorDescripcion($descripcion);
                echo json_encode($diagnostico, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function obtenerTiposDiagnostico() {
            try {
                $tiposDiagnostico = $this->triajeService->obtenerTiposDiagnostico();
                echo json_encode($tiposDiagnostico, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function obtenerGravedades() {
            try {
                $gravedades = $this->triajeService->obtenerGravedades();
                echo json_encode($gravedades, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function registrarTriaje(){
            
        }
    }
