<?php

    require_once __DIR__ . "/ConexionDatabase.php";
    class Model {
        protected $db; // Aquì se almacena la instancia de la conexiòn a la BD

        public function __construct() {
            $this->db = (new ConexionDatabase())->conectar();
        }

        // Método Select para un solo registro
        public function select(string $sql, array $params = []) {
            try {
                $stmt = $this->db->prepare($sql);
                $stmt->execute($params); // Parámetros vinculados
                return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna la fila

            } catch (PDOException $e) {
                error_log("Error en select(): " . $e->getMessage());
                return []; // Retorna array vacío en errores
            }
        }
        
        // Método Select para varios registros
        public function selectAll(string $sql, array $params = []) {
            try {
                $stmt = $this->db->prepare($sql);
                $stmt->execute($params);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                error_log("Error en selectAll(): " . $e->getMessage()); // Log del error
                return []; // Devuelve un array vacío en caso de error
            }
        }
        
        // Método Insert para un solo registro
        public function insert(string $sql, array $datos) {
            try {
                $stmt = $this->db->prepare($sql);
                $success = $stmt->execute($datos);
        
                // Si execute() falla, retorna false inmediatamente
                if (!$success) {
                    return false;
                }
        
                $lastId = $this->db->lastInsertId();
        
                // Verifica que el ID sea válido (mayor que 0)
                if ($lastId <= 0) {
                    error_log("Error: Inserción exitosa pero lastInsertId() retornó un valor inválido: $lastId");
                    return false;
                }
        
                return $lastId; // Retorna el ID generado (ej: 15)
        
            } catch (PDOException $e) {
                error_log("Error en insert(): " . $e->getMessage());
                return false;
            }
        }

        // Método Update para un solo registro
        public function update(string $sql, array $datos) {
            try {
                $stmt = $this->db->prepare($sql);
                $success = $stmt->execute($datos);
                
                if (!$success) {
                    return false; // Error en execute()
                }
                
                $filasAfectadas = $stmt->rowCount();
                return $filasAfectadas; // Retorna 0, 1, 2, ... (filas actualizadas)
                
            } catch (PDOException $e) {
                error_log("Error en update(): " . $e->getMessage());
                return false; // Error en prepare() o execute()
            }
        }

        // Método Delete para un solo registro
        public function delete(string $sql, array $datos) {
            try {
                $stmt = $this->db->prepare($sql); // Nombre claro ($stmt)
                $success = $stmt->execute($datos);
                
                if (!$success) {
                    return false; // Error en execute()
                }
                
                $filasEliminadas = $stmt->rowCount(); // Filas afectadas reales
                return $filasEliminadas; // Retorna 0, 1, 2, ...
                
            } catch (PDOException $e) {
                error_log("Error en delete(): " . $e->getMessage());
                return false; // Error en prepare() o execute()
            }
        }        
    }
