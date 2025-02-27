<?php
    class LoginModel extends Model {

        public function __construct(){
			parent::__construct();
		}

        public function validarUsuario($usuario) {
            $sql = "SELECT Usuario, Clave FROM dbo.Empleados WHERE Usuario = :usuario";
            $params = [
                ":usuario" => $usuario
            ];

            $usuario = $this->select($sql, $params);

            return $usuario ? $usuario : false; // Retorna el array del usuario o false
        }

        // Método para obtener todos los usuarios
        public function demoMethod() {
            $sql = "Consulta sql";  // Consulta SQL
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
