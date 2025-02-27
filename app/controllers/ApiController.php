<?php
    class ApiController extends Controller {
    
        public function obtenerToken() {
            try {
                $tokenAPI = getSessionApi();
                echo json_encode($tokenAPI, JSON_UNESCAPED_UNICODE);
            } catch (Exception $e) {
                return;
            }
        }

        public function consultarSis($tipoDocumento, $nmroDocumento){
            try {
                $token = getSessionApi(); // Método redatacto en helpers

                if (isset($token['error'])){
                    throw new Exception("pipipip");
                }
                
                $resultado = consultarAfiliado($token, $tipoDocumento, $nmroDocumento);

                if (empty($resultado['nombreCompleto']) || empty($resultado['estado'])){
                    $resultado = ["error" => "El paciente no fue encontrado"];
                }
                
                echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
            }
            catch(Exception $e){
                echo "pipipipipi";
            }
        }
    }