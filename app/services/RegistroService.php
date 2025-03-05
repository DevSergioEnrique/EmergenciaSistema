<?php

class RegistroService extends Service {
    protected $registroModel;

    public function __construct() {
        $this->registroModel = $this->getModel("RegistroModel");
    }

    public function getRegistroEmergencia() {
        $registroEmergencia = $this->registroModel->getRegistroEmergencia();

        // if (!$registroEmergencia) {
        //     return ["error" => "No se encontraron registros de emergencia"];
        // }

        return $registroEmergencia;
    }
}
