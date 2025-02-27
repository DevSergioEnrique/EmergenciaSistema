<?php

class DemoController extends Controller {

    protected $demoService;

    public function __construct() {
        // Iniciar sesión solo si no está iniciada
        // if (session_status() === PHP_SESSION_NONE) {
        //     session_start();
        // }
        
        $this->demoService = $this->getService("DemoService");
    
        // Si no está logueado, lo mandamos a login (evita que vuelva a login)
        // if (!isset($_SESSION['Usuario']) && empty($_SESSION['Usuario'])) {
        //     header('Location: ' . APP_URL . '/login');
        //     exit();
        // }    
    }

    // Método de acción para cargar la vista
    public function index() {

        $data = [
            'title' => 'Página de Inicio',
            'content' => 'Bienvenido a nuestra página de inicio.'
        ];

        $this->getView('home', $data);

        // echo View::renderComponent('admin.templates.administration', $data);
    }

    public function error() {

        $data = [
            'title' => 'Página de Errores',
            'content' => 'Bienvenido a nuestra página de inicio.'
        ];

        $this->getView('error', $data);

    }

    public function demoMethod() {
        try {
        return $this->demoService->demoMethod();

        } catch (Exception $e) {
            echo "Error al obtener los usuarios: " . $e->getMessage();
        }
    }

    public function showUser($id) {
        echo "User Showed: $id";
    }

    public function createUser() {
        
        echo "User Created";
    }

    public function updateUser($id) {
        echo "User ID $id Updated";
    }

    public function deleteUser($id) {
        echo "User ID $id Deleted";
    }

    public function twoParams($id, $webada) {
        echo "Primer param: $id y tu webada: $webada";
    }
}
