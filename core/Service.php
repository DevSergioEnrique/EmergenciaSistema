<?php

    class Service {

        public function getModel($model) {

            $modelFile = __DIR__ . '/../app/models/' . $model . '.php';

            if (file_exists($modelFile)) {

                include_once $modelFile; 
                return new $model();

            } else {
                throw new Exception("Modelo {$model} no encontrado.");
            }
        }
    }
