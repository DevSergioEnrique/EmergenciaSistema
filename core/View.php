<?php
    class View {

        public static function renderComponent($view, $data = []){

            $viewPath = str_replace('.', '/', $view);
            if (!isAjax()) {
                require_once __DIR__ . '/../views/admin/includes/header.php'; // Cargar solo cuando no es AJAX
            }

            if (isAjax()) {
                if (file_exists(__DIR__ . '/../views/' . $viewPath . '.php')) {
                    require_once __DIR__ . '/../views/' . $viewPath . '.php';
                } else {
                    die("View does not exist.");
                }
            }

            if (!isAjax()) {
                require_once __DIR__ . '/../views/admin/includes/footer.php'; // Cargar solo cuando no es AJAX
            }
        }
    }
