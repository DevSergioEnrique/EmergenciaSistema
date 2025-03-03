<?php
    class LoginModel extends Model {

        public function __construct(){
			parent::__construct();
		}

        public function validarUsuario($usuario) {
            $sql = "SELECT IdEmpleado, Usuario, RTRIM(DNI) AS DNI FROM dbo.Empleados WHERE Usuario = :usuario";
            $params = [
                ":usuario" => $usuario
            ];

            $usuario = $this->select($sql, $params);

            return $usuario ?: false; // Retorna el array del usuario o false
        }
    }
