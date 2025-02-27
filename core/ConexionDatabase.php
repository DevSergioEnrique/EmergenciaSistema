<?php

    class ConexionDatabase {
        private $host = DB_HOST; 
        private $dbname = DB_NAME;
        private $username = DB_USER;
        private $password = DB_PASS;
        private $port = DB_PORT;
        protected $conexion; // En esta variable se guarda el return del mètodo de conexiòn a la BD

        public function conectar() {

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            if ($this->conexion === null) {
                try {
                    $dsn = "sqlsrv:Server=". $this->host . ";Database=" . $this->dbname;
                    // Creación de la conexión a base de datos mediante instancia PDO
                    $this->conexion = new PDO($dsn, $this->username, $this->password, $options);
                } catch (PDOException $e) {
                    error_log("Error de conexión a la base de datos: " . $e->getMessage());

                    // Mostrar un mensaje de error genérico al usuario
                    die("Error al conectar a la base de datos. Por favor, inténtalo de nuevo más tarde.");
                }
            }

            // Instancia PDO de la conexiòn de la BD (return)
            return $this->conexion;
        }
    }
