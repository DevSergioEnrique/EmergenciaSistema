<?php
    class DemoService extends Service {

        protected $demoModel;

        public function __construct() {
            $this->demoModel = $this->getModel("DemoModel");;
        }

        public function demoMethod() {
            return $this->demoModel->demoMethod();
        }
    }
