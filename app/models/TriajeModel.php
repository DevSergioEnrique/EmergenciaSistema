<?php
    class TriajeModel extends Model {

        public function __construct(){
			parent::__construct();
		}
        
        public function obtenerTiposDocumento() {
            $sql = "SELECT TOP 5 IdDocIdentidad, Descripcion FROM dbo.TiposDocIdentidad";

            $tiposDocumento = $this->selectAll($sql);

            return $tiposDocumento ?: ["error" => "Los tipos de documentos no fueron bien referenciados"];
        }

        public function obtenerPaciente($tipoDocumento ,$nmroDocPaciente) {
            $sql = "SELECT 
                IdPaciente, 
                UPPER(COALESCE(ApellidoPaterno, '')) + ' ' + 
                UPPER(COALESCE(ApellidoMaterno, '')) + ' ' + 
                UPPER(COALESCE(PrimerNombre, '')) + ' ' + 
                COALESCE(UPPER(SegundoNombre), '') + ' ' + 
                COALESCE(UPPER(TercerNombre), '') AS Paciente 
            FROM dbo.Pacientes 
            WHERE IdDocIdentidad = :tipoDocumento 
            AND NroDocumento = :nmroDocPaciente"; 

            $params = [
                ":nmroDocPaciente" => $nmroDocPaciente,
                ":tipoDocumento" => $tipoDocumento
            ];

            $paciente = $this->select($sql, $params);

            return $paciente ?: ["error" => "El paciente no existe"];
        }

        public function obtenerFormasIngreso() {
            $sql = "SELECT IdFormaIngreso, Descripcion FROM dbo.FormaIngresoEmer";

            $formaIngreso = $this->selectAll($sql);

            return $formaIngreso ?: ["error" => "Las formas de ingreso no fueron bien referenciados"];
        }

        public function obtenerMotivosIngreso() {
            $sql = "SELECT IdMotivoIngreso, Descripcion FROM dbo.MotivoIngresoEmer ORDER BY Descripcion";

            $motivoIngreso = $this->selectAll($sql);

            return $motivoIngreso ?: ["error" => "Los motivos de ingreso no fueron bien referenciados"];
        }

        public function obtenerServicios(){
            $sql = "SELECT IdServicio, Nombre FROM dbo.Servicios WHERE IdTipoServicio = '2' ORDER BY Nombre";

            $servicios = $this->selectAll($sql);

            return $servicios ?: ["error" => "Los servicios no fueron bien referenciados"];
        }

        public function obtenerMedicos($idServicio) {
            $sql = "SELECT 
                        m.IdMedico, 
                        e.ApellidoPaterno + ' ' + e.ApellidoMaterno + ' ' + e.Nombres AS Medicos,
                        s.IdServicio,
                        s.Nombre AS Servicio
                    FROM Medicos m
                        INNER JOIN Empleados e ON m.IdEmpleado = e.IdEmpleado
                        INNER JOIN MedicosEspecialidad me ON m.IdMedico = me.IdMedico
                        INNER JOIN Servicios s ON me.IdEspecialidad = s.IdEspecialidad
                    WHERE s.IdTipoServicio = 2 AND s.IdServicio = :IdServicio
                    ORDER BY
                            CASE
                            WHEN nombre LIKE 'EMER. %' THEN 0
                            WHEN nombre LIKE 'SALA OBS. %' THEN 1
                            ELSE 2
                            END, nombre";

            $params = [
                ":IdServicio" => $idServicio
            ];

            $medicos = $this->selectAll($sql, $params);
            return $medicos ?: ["error" => "Los médicos no fueron bien referenciados"];
        }

        public function obtenerDiagnosticos() {
            $sql = "SELECT 
	                    IdDiagnostico, 
	                    RTRIM(CodigoCIE10) COLLATE Modern_Spanish_CI_AS AS Codigo, 
	                    Descripcion COLLATE Modern_Spanish_CI_AS AS Descripcion
                    FROM dbo.Diagnosticos";

            $diagnostico = $this->selectAll($sql);

            return $diagnostico ?: ["error" => "Los diferentes diagnosticos no fueron bien referenciados"];
        }

        public function obtenerDiagnosticoPorCodigo($codigo) {
            $sql = "SELECT 
	                    IdDiagnostico, 
	                    RTRIM(CodigoCIE10) COLLATE Modern_Spanish_CI_AS AS Codigo, 
	                    Descripcion COLLATE Modern_Spanish_CI_AS AS Descripcion
                    FROM dbo.Diagnosticos
                    WHERE 
                        RTRIM(CodigoCIE10) COLLATE Modern_Spanish_CI_AS LIKE :codigo;";

            $params = [
                ":codigo" => $codigo . "%"
            ];

            $diagnostico = $this->selectAll($sql, $params);

            return $diagnostico ?: ["error" => "Los diferentes de diagnosticos no fueron bien referenciados"];
        }

        public function obtenerDiagnosticoPorDescripcion($descripcion) {
            $sql = "SELECT 
	                    IdDiagnostico, 
	                    RTRIM(CodigoCIE10) COLLATE Modern_Spanish_CI_AS AS Codigo, 
	                    Descripcion COLLATE Modern_Spanish_CI_AS AS Descripcion
                    FROM dbo.Diagnosticos
                    WHERE 
                        Descripcion COLLATE Modern_Spanish_CI_AS LIKE :descripcion";

            $params = [
                ":descripcion" => $descripcion . "%"
            ];

            $diagnostico = $this->selectAll($sql, $params);

            return $diagnostico ?: ["error" => "Los diferentes de diagnosticos no fueron bien referenciados"];
        }

        public function obtenerTiposDiagnostico() {
            $sql = "SELECT TOP 3 IdSubclasificacionDx, Descripcion FROM SubclasificacionDiagnosticos";

            $tiposDiagnostico = $this->selectAll($sql);

            return $tiposDiagnostico ?: ["error" => "Los tipos de diagnosticos no fueron bien referenciados"];
        }

        public function obtenerGravedades() {
            $sql = "SELECT IdTipoGravedad, Descripcion FROM TiposGravedadAtencion";

            $gravedades = $this->selectAll($sql);

            return $gravedades ?: ["error" => "Los tipos de gravedad no fueron bien referenciados"];
        }
        
        public function registrarTriaje(array $datos) {
            try {
                $sql = "INSERT INTO dbo.RegistroEmergencia (
                        IdTipoDocumento, 
                        NroDocPaciente, 
                        Paciente, 
                        IdFormaIngreso, 
                        IdMotivoIngreso, 
                        IdServicio, 
                        IdMedico, 
                        IdGravedad, 
                        IdDiagnostico, 
                        IdTipoDiagnostico, 
                        IdFinanciamiento, 
                        IdUsuario, 
                        Fecha_Hora
                    )
                    VALUES (
                        :tipoDocumento,          -- IdTipoDocumento (ejemplo: 1 = DNI)
                        :nmroDocumento,          -- NroDocPaciente (ejemplo: número de DNI)
                        :paciente,               -- Paciente (nombre completo)
                        :formaIngreso,           -- IdFormaIngreso (ejemplo: 2 = Emergencia)
                        :motivoIngreso,          -- IdMotivoIngreso (ejemplo: 3 = Dolor de cabeza)
                        :servicio,               -- IdServicio (ejemplo: 4 = Urgencias)
                        :medico,                 -- IdMedico (ejemplo: 5 = Dr. García)
                        :gravedad,               -- IdGravedad (ejemplo: 1 = Leve)
                        :diagnostico,            -- IdDiagnostico (ejemplo: 10 = Migraña)
                        :tipoDiagnostico,        -- IdTipoDiagnostico (ejemplo: 2 = Presuntivo)
                        :financiamiento,         -- IdFinanciamiento (ejemplo: 3 = SIS)
                        :usuario,                -- IdUsuario (ejemplo: 6 = Usuario que registra)
                        DEFAULT                  -- Fecha_Hora (usa el valor por defecto: GETDATE())
                    )";

                $params = [
                    ':tipoDocumento'    => $datos['tipoDocumento'] ?? 0,
                    ':nmroDocumento'    => $datos['nmroDocumento'] ?? 'NN',
                    ':paciente'         => $datos['paciente'] ?? 'Anónimo',
                    ':formaIngreso'     => $datos['formaIngreso'] ?? 1,
                    ':motivoIngreso'    => $datos['motivoIngreso'] ?? 1,
                    ':servicio'         => $datos['servicio'] ?? 1,
                    ':medico'           => $datos['medico'] ?? 'Paquito',
                    ':gravedad'         => $datos['gravedad'] ?? 1,
                    ':diagnostico'      => $datos['diagnostico'] ?? '0000',
                    ':tipoDiagnostico'  => $datos['tipoDiagnostico'] ?? 'R',
                    ':financiamiento'   => $datos['financiamiento'] ?? 1,
                    ':usuario'          => $datos['usuario'] ?? 1
                ];

                $registrar = $this->insert($sql, $params);
        
                return $registrar;

            } catch (Exception $e) {
                echo $e.Message("No se pudo insertar: ");
                die();
            }
        }
    }
