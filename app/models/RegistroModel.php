<?php

class RegistroModel extends Model {
    public function __construct(){
        parent::__construct();
    }

    public function getRegistroEmergencia() {
        $sql = "SELECT 
            RE.IdTriajeEmergencia,
            TDI.Descripcion AS TipoDocumento,
            ISNULL(RE.NroDocPaciente, 'Sin Documento') AS NroDocumento, 
            RE.Paciente, 
            E.Nombres + ' ' + E.ApellidoPaterno AS Medico, 
            D.Descripcion AS Diagnostico,
            E2.Nombres + ' ' + E2.ApellidoPaterno AS Usuario,
            RE.Fecha_Hora
        FROM 
            RegistroEmergencia RE
        INNER JOIN 
            TiposDocIdentidad TDI ON RE.IdTipoDocumento = TDI.IdDocIdentidad
        INNER JOIN 
            Medicos M ON RE.IdMedico = M.IdMedico
        INNER JOIN 
            Empleados E ON M.IdEmpleado = E.IdEmpleado 
        INNER JOIN 
            Diagnosticos D ON RE.IdDiagnostico = D.IdDiagnostico
        INNER JOIN 
            Empleados E2 ON RE.IdUsuario = E2.IdEmpleado
        WHERE 
            YEAR(RE.Fecha_Hora) = YEAR(GETDATE()) 
        ORDER BY 
            RE.Fecha_Hora DESC;";

                $prueba = $this->selectAll($sql);
                return $prueba ?: ["error" => "No se encontraron registros de emergencia"];
    }
}