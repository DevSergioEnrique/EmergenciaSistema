<?php
    class LoginService extends Service {

        protected $loginModel;

        public function __construct() {
            $this->loginModel = $this->getModel("LoginModel");
        }
    
        public function autenticarUsuario($usuario, $clave) {
            $usuario = $this->loginModel->validarUsuario($usuario);
            
            // Verificar si el usuario existe
            if (!$usuario) {
                return ["error" => "El usuario no existe"]; // Devuelve un array con msg de error
            }
        
            if ($clave !== $usuario["Clave"]) { // RECORDAR HASHEAR
                return ["error" => "Password incorrecto"]; // Devuelve un array con msg de error
            }

            return $usuario; // Devuelve el array con los datos del usuario
        }
    }
