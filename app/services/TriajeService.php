<?php
    class TriajeService extends Service {

        protected $triajeModel;

        public function __construct() {
            $this->triajeModel = $this->getModel("TriajeModel");
        }

        public function obtenerTiposDocumento(){
            $tiposDocumento = $this->triajeModel->obtenerTiposDocumento();

            // if (!$tiposDocumento) {
            //     return ["error" => "Los tipos de documentos no fueron bien referenciados"];
            // }

            return $tiposDocumento;
        }

        public function obtenerPaciente($tipoDocumento ,$nmroDocPaciente) {
            $paciente = $this->triajeModel->obtenerPaciente($tipoDocumento, $nmroDocPaciente);

            // if (!$paciente) {
            //     return ["error" => "El paciente no existe"];
            // }

            return $paciente;
        }

        public function obtenerFormasIngreso(){
            $formasIngreso = $this->triajeModel->obtenerFormasIngreso();

            // if (!$formasIngreso) {
            //     return ["error" => "Las formas de ingreso no fueron bien referenciados"];
            // }

            return $formasIngreso;
        }

        public function obtenerMotivosIngreso(){
            $motivosIngreso = $this->triajeModel->obtenerMotivosIngreso();

            // if (!$motivosIngreso) {
            //     return ["error" => "Los motivos de ingreso no fueron bien referenciados"];
            // }

            return $motivosIngreso;
        }

        
        public function obtenerServicios(){
            $servicios = $this->triajeModel->obtenerServicios();

            // if (!$servicios) {
            //     return ["error" => "Los servicios no fueron bien referenciados"];
            // }

            return $servicios;
        }

        public function obtenerMedicos($idServicio) {
            $medicos = $this->triajeModel->obtenerMedicos($idServicio);
            return $medicos;
        }

        public function obtenerDiagnosticos() {
            $diagnostico = $this->triajeModel->obtenerDiagnosticos();

            // if (!$motivosIngreso) {
            //     return ["error" => "Los motivos de ingreso no fueron bien referenciados"];
            // }

            return $diagnostico;
        }

        public function obtenerDiagnosticoPorCodigo($codigo) {
            $diagnostico = $this->triajeModel->obtenerDiagnosticoPorCodigo($codigo);

            // if (!$motivosIngreso) {
            //     return ["error" => "Los motivos de ingreso no fueron bien referenciados"];
            // }

            return $diagnostico;
        }

        public function obtenerDiagnosticoPorDescripcion($descripcion) {
            $diagnostico = $this->triajeModel->obtenerDiagnosticoPorDescripcion($descripcion);

            // if (!$motivosIngreso) {
            //     return ["error" => "Los motivos de ingreso no fueron bien referenciados"];
            // }

            return $diagnostico;
        }

        public function obtenerTiposDiagnostico() {
            $tiposDiagnostico = $this->triajeModel->obtenerTiposDiagnostico();

            // if (!$motivosIngreso) {
            //     return ["error" => "Los motivos de ingreso no fueron bien referenciados"];
            // }

            return $tiposDiagnostico;
        }

        public function obtenerGravedades() {
            $gravedades = $this->triajeModel->obtenerGravedades();

            // if (!$motivosIngreso) {
            //     return ["error" => "Los motivos de ingreso no fueron bien referenciados"];
            // }

            return $gravedades;
        }
    }
