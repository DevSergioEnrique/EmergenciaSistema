<?php

    class Controller {
        
        // Método para cargar una vista
        public function getView($view, $data = []) {

            $viewFile = __DIR__ . '/../app/views/' . $view . '.php';

            if (file_exists($viewFile)) {
                extract($data);  

                include_once $viewFile;  

            } else {
                die("Vista no encontrada: $view");
            }
        }

        public function getService($service) {

            $serviceFile = __DIR__ . '/../app/services/' . $service . '.php';

            if (file_exists($serviceFile)) {

                include_once $serviceFile; 
                return new $service();

            } else {
                throw new Exception("Servicio {$service} no encontrado.");
            }
        }
    }
