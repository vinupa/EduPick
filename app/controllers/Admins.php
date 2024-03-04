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

        public function manageAdmins(){
            $data = [
                'admins' => $this->adminModel->getAdmins()
            ];
            $this->view('admins/manageAdmins', $data);
        }

        public function updateAdmin($adminID) {
            // Check if the form is submitted (POST request)
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form data
                
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
                // Collect form data
                $data = [
                    'adminID' => $adminID,
                    'firstName' => trim($_POST['first_name']),
                    'lastName' => trim($_POST['last_name']),
                    'email' => trim($_POST['email']),
                    'contactNumber' => trim($_POST['contact_number']),
                    'firstName_err' => '',
                    'lastName_err' => '',
                    'email_err' => '',
                    'contactNumber_err' => ''
                ];
        
                // Validate form data (you can add more validation rules as needed)
                if (empty($data['firstName'])) {
                    $data['firstName_err'] = 'Please enter first name';
                }
        
                if (empty($data['lastName'])) {
                    $data['lastName_err'] = 'Please enter last name';
                }
        
                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter email';
                }
        
                if (empty($data['contactNumber'])) {
                    $data['contactNumber_err'] = 'Please enter contact number';
                }
        
                // If no errors, update admin in the database
                if (empty($data['firstName_err']) && empty($data['lastName_err']) && empty($data['email_err']) && empty($data['contactNumber_err'])) {
                    // Update admin in the database
                    if ($this->adminModel->updateAdmin($data)) {
                        // Admin updated successfully
                        flash('success', 'Admin updated');
                        redirect('admins/index');
                    } else {
                        // Failed to update admin
                        flash('error', 'Failed to update admin', 'alert alert-danger');
                        redirect('admins/index');
                    }
                } else {
                    // Load view with validation errors
                    $this->view('admins/updateAdmin', $data); // Assuming you have a view named 'updateAdmin.php'
                }
            } else {
                // If it's not a POST request, load the update admin form with existing data
                $admin = $this->adminModel->getAdminById($adminID);
        
                if ($admin) {
                    // Admin found, load the update admin form with existing data
                    $data = [
                        'adminID' => $adminID,
                        'firstName' => $admin->firstName,
                        'lastName' => $admin->lastName,
                        'email' => $admin->email,
                        'contactNumber' => $admin->contactNumber,
                        'firstName_err' => '',
                        'lastName_err' => '',
                        'email_err' => '',
                        'contactNumber_err' => ''
                    ];
                    $this->view('admins/updateAdmin', $data); // Assuming you have a view named 'updateAdmin.php'
                } else {
                    // Admin not found, display an error message or redirect
                    flash('error', 'Admin not found', 'alert alert-danger');
                    redirect('admins/index');
                }
            }
        }

        public function removeAdmin($adminID){
            // Reject the vehicle with the given ID
            if($this->adminModel->removeAdmin($adminID)){
                // Redirect to view vehicle requests page
                flash('success', 'Admin Removed');
                redirect('admins/index');
            } else {
                flash('error', 'Failed to remove admin', 'alert alert-danger');
                redirect('admins/index');
            }
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