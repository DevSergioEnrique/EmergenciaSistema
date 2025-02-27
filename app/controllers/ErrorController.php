<?php

    class ErrorController extends Controller {

        public function __construct() {
            // Iniciar sesión solo si no está iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }   
        }

        public function error() {

            $data = [
                'title' => 'Página de Errores',
                'content' => 'Bienvenido a nuestra página de inicio.'
            ];

            $this->getView('error', $data);

        }
    }
