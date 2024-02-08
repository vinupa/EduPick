<?php
    #[\AllowDynamicProperties]
    
    class Admins extends Controller {

        public function __construct(){
            if(!isset($_SESSION['user_id'])){
                redirect('users/login');
            } elseif($_SESSION['user_type'] != 'admin'){
                redirect('users/login');
            }

            // $this->adminModel = $this->model('Admin');
        }

        public function index(){
            $data = [];
            $this->view('admins/index', $data);
        }
    }