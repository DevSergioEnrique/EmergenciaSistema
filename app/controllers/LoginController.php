<?php

    class LoginController extends Controller {

        protected $loginService;

        public function __construct() {

            // Iniciar sesión solo si no está iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Si ya está logueado, lo mandamos a home (evita que vuelva a login)
            if (isset($_SESSION['Usuario']) && !empty($_SESSION['Usuario'])) {
                header('Location: ' . APP_URL . '/pacientes');
                exit();
            }

            $this->loginService = $this->getService("LoginService");
        }

        public function index() {
            
            // Verificar si ya se iniciò sesiòn o no. Recordar!
            $data = [
                'title' => 'Iniciar sesión',
                'content' => 'Bienvenido a nuestra página de inicio.'
            ];
            $this->getView('Login/login', $data);
        }


        public function iniciarSesion() {
            try {
                // Validar método HTTP
                if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                    throw new Exception("Método HTTP no permitido");
                }

                // Validar CSRF (sin detalles en el mensaje de error)
                if (!isset($_SESSION['csrf_token']) || !isset($_POST["csrf_token"]) || 
                !hash_equals($_SESSION['csrf_token'], $_POST["csrf_token"])) {
                
                    error_log("CSRF inválido. IP: " . $_SERVER['REMOTE_ADDR']);
                    throw new Exception("Error de seguridad");
                }
                
                // Sanitizar y validar que los campos no estén vacíos
                $nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''), ENT_QUOTES, 'UTF-8');
                $password = $_POST['password'] ?? '';
        
                if (empty($nombre) || empty($password)) {
                    $_SESSION['error'] = "Campos vacíos. Inserte sus credenciales";
                    header('Location: ' . APP_URL . '/login');
                    exit();
                }
        
                // Autenticar (debe usar password_verify() internamente)
                $usuario = $this->loginService->autenticarUsuario($nombre, $password);
        
                if (isset($usuario["error"])) {
                    $_SESSION['error'] = $usuario["error"];
                    header('Location: ' . APP_URL . '/login');
                    exit();
                }

                // Regenerar ID de sesión
                session_regenerate_id(true);
                unset($_SESSION['error']);
        
                // Guardar datos en sesión
                $_SESSION['Usuario'] = $usuario['Usuario'];
                $_SESSION['Clave'] = $usuario['Clave'];

                header('Location: ' . APP_URL . '/pacientes');
                exit();
        
            } catch (Exception $e) {
                error_log("Error en iniciarSesion: " . $e->getMessage());
                $_SESSION['error'] = $e->getMessage();
                header('Location: ' . APP_URL . '/login');
                exit();
            }
        }
    }   