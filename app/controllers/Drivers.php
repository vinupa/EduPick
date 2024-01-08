<?php
    #[\AllowDynamicProperties]
    
    class Drivers extends Controller {

        public function __construct(){
            if(!isset($_SESSION['user_id'])){
                redirect('users/login');
            } elseif($_SESSION['user_type'] != 'driver'){
                redirect('users/login');
            }

            // $this->driverModel = $this->model('Driver');
        }

        public function index(){
            $data = [];
            $this->view('drivers/index', $data);
        }
    }