<?php

    class LogoutController extends Controller{
        public function cerrarSesion(){
            try {
                // Iniciar sesión solo si no está iniciada
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                // 1. Vaciar variables de sesión
                session_unset();

                // 2. Regenerar ID de sesión (antes de destruir)
                session_regenerate_id(true);

                // 3. Destruir sesión
                session_destroy();

                // Redirigir desde el controlador (responsabilidad MVC)
                header('Location: ' . APP_URL . '/login');
                exit();

            } catch (Exception $e) {
                // Loggear error (nunca mostrar detalles al usuario)
                error_log("Error en cerrarSesion: " . $e->getMessage());

                // Guardar el mensaje en la sesión
                $_SESSION['error'] = "Hubo un problema al cerrar sesión: " . $e->getMessage();
        
                // Redirigir a una página de error
                header('Location: ' . APP_URL . '/error');
                exit();
            }
		}
    }
