<?php
    class DemoModel extends Model {

        // Método para obtener todos los usuarios
        public function demoMethod() {
            $sql = "Consulta sql";  // Consulta SQL
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
