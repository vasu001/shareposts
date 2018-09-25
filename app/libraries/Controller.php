<!-- To make easier the loading of MODELs and VIEWs. Every other controller will extend this class -->

<?php

    /*
    * Base Controller
    * Loads Models and Views
    */

    class Controller {
        //  Load Model
        public function model($model) {
            if(file_exists('../app/models/' . $model . '.php')){
                // Require model file
            require_once '../app/models/' . $model . '.php';

            // Instantiate model
            return new $model();
            } else {
                die('Model doesn\'t exists');
            }
        }

        // Load View
        public function view($view, $data = []) { // data[] is there to let the data be passed to the view
            // Require view file
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            } else {
                die('View doesn\'t exits');
            }
        }
    }