<?php
    /*
     * Base Controller
     * Loads the models and views
     */

     class Controller{

        // Load Model
        public function model($model){
            // Require model file
            require_once '../app/models/' . $model . '.php';

            // Instantiate model
            return new $model();
        }


        // Load View
        public function view($view, $data = []){

           //$view = $view ?? '_'; // If the value passed is null set to a string with underscore (non-empty) to avoid deprecated error

            // Check for view file
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            } else {
                // View does not exist
                die('View does not exist');
            }
        }

     }