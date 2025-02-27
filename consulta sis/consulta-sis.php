<?php

    // Función para obtener la autorización mediante GetSession
    function getSession() {
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
        
        return $authCode;
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
        
        return [
            'nombreCompleto' => $nombreCompleto,
            'estado'         => $estado
        ];
    }

    // Procesar el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tipoDocumento = $_POST['tipoDocumento'];
        $nroDocumento  = trim($_POST['nroDocumento']);
        
        // Validaciones básicas
        if ($tipoDocumento == '1' && strlen($nroDocumento) != 8) {
            echo "<p style='color:red;'>Error: El DNI debe tener 8 dígitos.</p>";
            exit;
        } elseif ($tipoDocumento == '2' && strlen($nroDocumento) > 10) {
            echo "<p style='color:red;'>Error: El CE no puede exceder los 10 dígitos.</p>";
            exit;
        }
        
        // Obtener la autorización
        $authCode = getSession();
        if (!$authCode) {
            echo "<p style='color:red;'>Error al obtener la autorización.</p>";
            exit;
        }
        
        // Realizar la consulta
        $resultado = consultarAfiliado($authCode, $tipoDocumento, $nroDocumento);
        if (!$resultado) {
            echo "<p style='color:red;'>No se pudo procesar la respuesta del servidor.</p>";
            exit;
        }
        
        // Imprimir solo el nombre completo y el estado SIS
        echo "<h2>Resultado de la consulta:</h2>";
        echo "<p><strong>Nombre Completo:</strong> " . $resultado['nombreCompleto'] . "</p>";
        echo "<p><strong>Estado SIS:</strong> " . $resultado['estado'] . "</p>";
    } else {
        echo "<p style='color:red;'>Acceso no permitido.</p>";
    }

