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

        public function driverApproval(){
            // Fetch all driver requests awaiting approval
            $driverRequests = $this->adminModel->getDriverRequests();
            
            // Pass the driver requests data to the view
            $data = [
                'driverRequests' => $driverRequests
            ];
            
            // Load the view to display driver requests
            $this->view('admins/driverApproval', $data);
        }
    
        public function driverApprovalDetails($driverID){
            // Fetch details of a specific driver by their ID
            $driverDetails = $this->adminModel->getDriverDetails($driverID);
            
            // Pass the driver details data to the view
            $data = [
                'driverDetails' => $driverDetails
            ];
            
            // Load the view to display driver details
            $this->view('admins/driverApprovalDetails', $data);
        }

        public function approveVehicle($vehicleID){
            // Approve the vehicle with the given ID
            if($this->adminModel->approveVehicle($vehicleID)){
                // Redirect to view vehicle requests page
                flash('success', 'Vehicle approved');
                redirect('admins/vehicleApproval');
            } else {
                flash('error', 'Failed to approve vehicle', 'alert alert-danger');
                redirect('admins/vehicleApproval');
            }
        }
        
        public function rejectVehicle($vehicleID){
            // Reject the vehicle with the given ID
            if($this->adminModel->rejectVehicle($vehicleID)){
                // Redirect to view vehicle requests page
                flash('success', 'Vehicle rejected');
                redirect('admins/vehicleApproval');
            } else {
                flash('error', 'Failed to reject vehicle', 'alert alert-danger');
                redirect('admins/vehicleApproval');
            }
        }

        public function approveDriver($driverID){
            // Approve the vehicle with the given ID
            if($this->adminModel->approveDriver($driverID)){
                // Redirect to view vehicle requests page
                flash('success', 'Driver approved');
                redirect('admins/driverApproval');
            } else {
                flash('error', 'Failed to approve driver', 'alert alert-danger');
                redirect('admins/driverApproval');
            }
        }
        
        public function rejectDriver($driverID){
            // Reject the vehicle with the given ID
            if($this->adminModel->rejectDriver($driverID)){
                // Redirect to view vehicle requests page
                flash('success', 'Driver rejected');
                redirect('admins/driverApproval');
            } else {
                flash('error', 'Failed to reject driver', 'alert alert-danger');
                redirect('admins/driverApproval');
            }
        }
    }