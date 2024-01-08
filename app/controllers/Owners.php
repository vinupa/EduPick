<?php
    #[\AllowDynamicProperties]
    
    class Owners extends Controller {

        public function __construct(){
            if(!isset($_SESSION['user_id'])){
                redirect('users/login');
            } elseif($_SESSION['user_type'] != 'owner'){
                redirect('users/login');
            }

            // $this->ownerModel = $this->model('Owner');
        }

        public function index(){
            $data = [];
            $this->view('owners/index', $data);
        }
    }