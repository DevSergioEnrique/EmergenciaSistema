<?php

    function getHeader(){
        $header = __DIR__ . "/../app/views/Layouts/header.php";
        require_once $header;
    }

    function getFooter(){
        $footer = __DIR__ . "/app/views/Layouts/footer.php";
        require_once $footer;
    }

    // Método de transformación de cadenas de texto para prevenir inyecciones SQL 
    function strClean($strCadena){

        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $string = trim($string); //Elimina espacios en blanco al inicio y al final
        $string = stripslashes($string); // Elimina las \ invertidas
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("<script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'='1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);

        return $string;
    }

    function getSessionApi() {
        $url = "http://app.sis.gob.pe/sisWSAFI/Service.asmx";
        $soapAction = "http://sis.gob.pe/GetSession";
        $xmlRequest = '<?xml version="1.0" encoding="utf-8"?> 
                <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                            xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
                            xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                    <soap:Body>
                        <GetSession xmlns="http://sis.gob.pe/">
                            <strUsuario>00036034</strUsuario>
                            <strClave>V73#53emC</strClave>
                        </GetSession>
                    </soap:Body>
                </soap:Envelope>';
        
        $headers = [
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: $soapAction",
            "Content-Length: " . strlen($xmlRequest)
        ];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo "<p style='color:red;'>Error en CURL (GetSession): " . curl_error($ch) . "</p>";
            return false;
        }
        curl_close($ch);
        
        $xml = simplexml_load_string($response);
        if ($xml === false) {
            echo "<p style='color:red;'>Error al parsear la respuesta de GetSession.</p>";
            return false;
        }
        $namespaces = $xml->getNamespaces(true);
        $body = $xml->children($namespaces['soap'])->Body;
        $sessionResponse = $body->children()->GetSessionResponse;
        $authCode = (string)$sessionResponse->GetSessionResult;

        $resultado = $authCode ?: ["error" => "El token no fue bien generado"];
        
        return $resultado;
    }

    // Función para consultar al afiliado y extraer solo nombre y estado
    function consultarAfiliado($authCode, $tipoDocumento, $nroDocumento) {
        $url = "http://app.sis.gob.pe/sisWSAFI/Service.asmx";
        $soapAction = "http://sis.gob.pe/ConsultarAfiliadoFuaE";
        
        // Parámetros fijos
        $intOpcion = 1;
        $strDni = "45923462"; // DNI autorizado fijo
        
        $xmlRequest = '<?xml version="1.0" encoding="utf-8"?> 
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
                xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <ConsultarAfiliadoFuaE xmlns="http://sis.gob.pe/">
        <intOpcion>' . $intOpcion . '</intOpcion>
        <strAutorizacion>' . $authCode . '</strAutorizacion>
        <strDni>' . $strDni . '</strDni>
        <strTipoDocumento>' . $tipoDocumento . '</strTipoDocumento>
        <strNroDocumento>' . $nroDocumento . '</strNroDocumento>
        </ConsultarAfiliadoFuaE>
    </soap:Body>
    </soap:Envelope>';
        
        $headers = [
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: $soapAction",
            "Content-Length: " . strlen($xmlRequest)
        ];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo "<p style='color:red;'>Error en CURL (ConsultarAfiliadoFuaE): " . curl_error($ch) . "</p>";
            return false;
        }
        curl_close($ch);
        
        $xml = simplexml_load_string($response);
        if ($xml === false) {
            echo "<p style='color:red;'>Error al parsear la respuesta de ConsultarAfiliadoFuaE.</p>";
            return false;
        }
        $namespaces = $xml->getNamespaces(true);
        $body = $xml->children($namespaces['soap'])->Body;
        // Acceder al contenido usando el namespace de SIS
        $consultaResponse = $body->children("http://sis.gob.pe/")->ConsultarAfiliadoFuaEResponse;
        if (!$consultaResponse) {
            echo "<p style='color:red;'>No se encontró la respuesta de ConsultarAfiliadoFuaE.</p>";
            return false;
        }
        $consultaResult = $consultaResponse->ConsultarAfiliadoFuaEResult;
        if (!$consultaResult) {
            echo "<p style='color:red;'>No se encontró el resultado de la consulta.</p>";
            return false;
        }
        
        // Aquí $consultaResult ya es un SimpleXMLElement con los datos
        $nombreCompleto = trim($consultaResult->ApePaterno . ' ' . $consultaResult->ApeMaterno . ' ' . $consultaResult->Nombres);
        $estado = (string)$consultaResult->Estado;

        $resultado = [
            'nombreCompleto' => $nombreCompleto,
            'estado'         => $estado
        ];
        
        return $resultado ?: ["error" => "El token no fue bien generado"] ;
    }


