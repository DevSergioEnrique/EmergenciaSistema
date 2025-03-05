<?php

class RegistroController extends Controller {

    protected $registroService;

    public function __construct() {
        // Iniciar sesión solo si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->registroService = $this->getService("registroService");
    
        // Si no está logueado, lo mandamos a login (evita que ingrese sin logueo)
        if (!isset($_SESSION['Usuario']) && empty($_SESSION['Usuario'])) {
            header('Location: ' . APP_URL . '/login');
            exit();
        }    
    }

    public function index() {
        $data = [
            'title' => 'Pacientes',
            'content' => 'Bienvenido a nuestra página de inicio.'
        ];

        $this->getView('Pacientes/pacientes', $data);
    }

    public function getRegistroEmergencia() {
        try {
            $registroEmergencia = $this->registroService->getRegistroEmergencia();
            echo json_encode($registroEmergencia, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            return;
        }
    }
}