<?php
    #[\AllowDynamicProperties]
    
    class Admins extends Controller {

        public function __construct(){
            if(!isset($_SESSION['user_id'])){
                redirect('users/login');
            } elseif($_SESSION['user_type'] != 'admin'){
                redirect('users/login');
            }

            $this->adminModel = $this->model('Admin_');
        }

        public function index(){
            $data = [];
            $this->view('admins/index', $data);
        }

        public function vehicleApproval(){
            // Fetch all vehicle requests awaiting approval
            $vehicleRequests = $this->adminModel->getVehicleRequests();
    
            // Pass the vehicle requests data to the view
            $data = [
                'vehicleRequests' => $vehicleRequests
            ];
    
            // Load the view to display vehicle requests
            $this->view('admins/vehicleApproval', $data);
        }

        public function vehicleApprovalDetails($vehicleID){
            // Fetch details of a specific vehicle by its ID
            $vehicleDetails = $this->adminModel->getVehicleDetails($vehicleID);
    
            // Pass the vehicle details data to the view
            $data = [
                'vehicleDetails' => $vehicleDetails
            ];
    
            // Load the view to display vehicle details
            $this->view('admins/vehicleApprovalDetails', $data);
        }
    }