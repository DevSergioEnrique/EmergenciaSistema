<?php

class Router {

    private $routes = [];

    public function __construct() {
        // Inicia el enrutador
    }

    public function get($route, $action) {
        $this->addRoute('GET', $route, $action);
    }

    public function post($route, $action) {
        $this->addRoute('POST', $route, $action);
    }

    public function put($route, $action) {
        $this->addRoute('PUT', $route, $action);
    }

    public function delete($route, $action) {
        $this->addRoute('DELETE', $route, $action);
    }

    private function addRoute($method, $route, $action) {
        $this->routes[] = [
            'method' => $method,
            'route' => $route,
            'action' => $action
        ];
    }

    public function run() {

        $url = $_SERVER['REQUEST_URI'];

        $basePath = '/' . APP_NAME;  // Aquí debes poner el nombre de tu proyecto
        if (strpos($url, $basePath) === 0) {
            $url = substr($url, strlen($basePath));  // Elimina '/mi_proyecto' de la URL
        }

        $method = $_SERVER['REQUEST_METHOD'];
        $params = [];

        foreach ($this->routes as $route) {

            $pattern = preg_replace('/{(\w+)}/', '([^/]+)', $route['route']);

            if (preg_match('#^' . $pattern . '$#', $url, $matches) && $route['method'] === $method) {

                array_shift($matches);
                $params = $matches;
                $action = explode('@', $route['action']);
                $controllerName = $action[0];
                $methodName = $action[1];

                // Cargar el controlador
                require_once "././app/controllers/{$controllerName}.php";
                $controller = new $controllerName();
                call_user_func_array([$controller, $methodName], $params);
                return;

            }
        }

        echo "Route not found";
    }
}
