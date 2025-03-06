<?php

class RegistroModel extends Model {
    public function __construct(){
        parent::__construct();
    }

    public function getRegistroEmergencia() {
        $sql = "SELECT 
	re.IdTriajeEmergencia AS IdTriajeEmergencia,
	tdi.Descripcion AS Documento,
	COALESCE(NULLIF(re.NroDocPaciente, ''), 'Sin Documento') AS Nro,
	re.Paciente AS Paciente,
	fi.Descripcion AS FormaIngreso,
	mi.Descripcion AS MotivoIngreso,
	s.Nombre AS Servicio,
	re.Medico AS Medico,
	tga.Descripcion AS Gravedad,
	re.CodigoDiagnostico AS CodigoDiagnostico,
	d.Descripcion AS DescripcionDiagnostico,
	sb.Descripcion AS TipoDiagnostico,
	tf.Descripcion AS Financiamiento,
	e.Usuario AS Usuario,
	re.Fecha_Hora AS FechaHora
FROM 
	dbo.RegistroEmergencia AS re
		INNER JOIN 
	dbo.TiposDocIdentidad AS tdi ON re.IdTipoDocumento = tdi.IdDocIdentidad
		INNER JOIN
	dbo.FormaIngresoEmer AS fi ON re.IdFormaIngreso = fi.IdFormaIngreso
		INNER JOIN 
	dbo.MotivoIngresoEmer AS mi ON re.IdMotivoIngreso = mi.IdMotivoIngreso
		INNER JOIN
	dbo.Servicios AS s ON re.IdServicio = s.IdServicio
		INNER JOIN
	dbo.TiposGravedadAtencion AS tga ON re.IdGravedad = tga.IdTipoGravedad
		INNER JOIN
	(SELECT IdDiagnostico, CodigoCIE10, Descripcion FROM dbo.Diagnosticos) AS d ON re.CodigoDiagnostico + '     ' = d.CodigoCIE10
		INNER JOIN
	dbo.SubclasificacionDiagnosticos AS sb ON re.IdTipoDiagnostico = sb.IdSubclasificacionDx
		INNER JOIN
	dbo.TiposFinanciamiento AS tf ON re.IdFinanciamiento = tf.IdTipoFinanciamiento
		INNER JOIN
	dbo.Empleados AS e ON re.IdUsuario = e.IdEmpleado";

                $prueba = $this->selectAll($sql);
                return $prueba ?: ["error" => "No se encontraron registros de emergencia"];
    }
}