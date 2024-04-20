<?php
    #[\AllowDynamicProperties]
    
    class Owners extends Controller {

        public function __construct(){
            if(!isset($_SESSION['user_id'])){
                redirect('users/login');
            } elseif($_SESSION['user_type'] != 'owner'){
                redirect('users/login');
            }

            $this->ownerModel = $this->model('Owner_');
        }

        public function index(){
            $data = [];
            $this->view('owners/index', $data);
        }

        public function manageVehicles(){
            $data = [
                'vehicles' => $this->ownerModel->getVehicles($_SESSION['user_id'])
            ];
            $this->view('owners/Manage-vehicles', $data);
        }

        public function addVehicle(){

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

                $data = [
                    'licensePlate' => trim($_POST['licensePlate']),
                    'vacantSeats' => trim($_POST['vacantSeats']),
                    'totalSeats' => trim($_POST['totalSeats']),
                    'ownerID' => $_SESSION['user_id'],
                    'cities' => trim($_POST['cities']),
                    'schools' => trim($_POST['schools']),
                    'features' => trim($_POST['features']),
                    'licensePlate_err' => '',
                    'vacantSeats_err' => '',
                    'totalSeats_err' => '',
                    'cities_err' => '',
                    'schools_err' => '',
                    'features_err' => ''
                ];

                

                // Validate license plate 
                if(empty($data['licensePlate'])){
                    $data['licensePlate_err'] = 'Please enter licence plate number';
                }

                // Validate vacant seats
                if (empty($data['vacantSeats'])) {
                    $data['vacantSeats'] = 'Please enter the number of vacant seats';
                } elseif ($data['vacantSeats'] < 0 || $data['vacantSeats'] > $data['totalSeats']) {
                      $data['vacantSeats_err'] = 'Please enter a valid number of vacant seats';
                }

                // Validate total seats
                if(empty($data['totalSeats'])){
                    $data['totalSeats'] = 'Please enter total number of seats';
                } elseif($data['totalSeats'] < 1 || $data['totalSeats'] > 55){
                    $data['totalSeats_err'] = 'Please enter a valid number of seats';
                }

                // Validate cities
                if(empty($data['cities'])){
                    $data['cities_err'] = 'Please enter the cities ';
                }

                // Validate school
                if(empty($data['school'])){
                    $data['school_err'] = 'Please enter the schools';
                }

                 // Validate features
                 if(empty($data['features'])){
                    $data['features_err'] = 'Please enter the features (colour)';
                }


                // Make sure no errors
                if(empty($data['licensePlate_err']) && empty($data['vacantSeats_err']) && empty($data['totalSeats_err']) && empty($data['cities_err']) && empty($data['schools_err']) && empty($data['features_err'])){
                    // Validated

                    // Execute
                    if($this->ownerModel->addVehicle($data)){
                        // Redirect to manage
                        redirect('owners/Owner-dashbord');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('owners/Vehicle-registration', $data);
                }

            } else {
                // Init data
                $data = [
                    'licensePlate' => '',
                    'vacantSeats' => '',
                    'totalSeats' => '',
                    'ownerID' => '',
                    'cities' => '',
                    'schools' => '',
                    'features' => '',
                    'licensePlate' => '',
                    'vacantSeats' => '',
                    'totalSeats' => '',
                    'cities_err' => '',
                    'schools_err' => '',
                    'features_err' => ''
                    
                ];

                // Load view
                $this->view('owners/Vehicle-registration', $data);
        }
    }


        public function removeVehicle($vehicle_id){
            if($this->ownerModel->removeVehicle($vehicle_id)){
                redirect('owners/Owner-dashbord');
            } else {
                die('Something went wrong');
            }
        }

        public function updateVehicledPost(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);


                $data = [
                    'vehicle_id' => trim($_POST['vehicle_id']),
                    'licensePlate' => trim($_POST['licensePlate']),
                    'vacantSeats' => trim($_POST['vacantSeats']),
                    'totalSeats' => trim($_POST['totalSeats']),
                    'ownerID' => $_SESSION['user_id'],
                    'cities' => trim($_POST['cities']),
                    'schools' => trim($_POST['schools']),
                    'features' => trim($_POST['features']),
                    'licensePlate_err' => '',
                    'vacantSeats_err' => '',
                    'totalSeats_err' => '',
                    'cities_err' => '',
                    'schools_err' => '',
                    'features_err' => ''
                ];


                // Validate license plate 
                if(empty($data['licensePlate'])){
                    $data['licensePlate_err'] = 'Please enter licence plate number';
                }

                // Validate vacant seats
                if (empty($data['vacantSeats'])) {
                    $data['vacantSeats'] = 'Please enter the number of vacant seats';
                } elseif ($data['vacantSeats'] < 0 || $data['vacantSeats'] > $data['totalSeats']) {
                      $data['vacantSeats_err'] = 'Please enter a valid number of vacant seats';
                }

                // Validate total seats
                if(empty($data['totalSeats'])){
                    $data['totalSeats'] = 'Please enter total number of seats';
                } elseif($data['totalSeats'] < 1 || $data['totalSeats'] > 55){
                    $data['totalSeats_err'] = 'Please enter a valid number of seats';
                }

                // Validate cities
                if(empty($data['cities'])){
                    $data['cities_err'] = 'Please enter the cities ';
                }

                // Validate school
                if(empty($data['school'])){
                    $data['school_err'] = 'Please enter the schools';
                }

                 // Validate features
                 if(empty($data['features'])){
                    $data['features_err'] = 'Please enter the features (colour)';
                }


                // Make sure no errors
                if(empty($data['licensePlate_err']) && empty($data['vacantSeats_err']) && empty($data['totalSeats_err']) && empty($data['cities_err']) && empty($data['schools_err']) && empty($data['features_err'])){
                    // Validated

                    // Execute
                    if($this->ownerModel->updateVehicle($data)){
                        // Redirect to Owner dashbord
                        redirect('owners/Owner-dashbord');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('parents/Vehicle-edit', $data);
                }

            }
        }

        public function updateVehicle($vehicle_id){
            // Get vehicle data from vehicle id and fill the form
            $vehicle = $this->ownerModel->getvehicle($vehicle_id);
            if($vehicle->ownerID != $_SESSION['user_id']){
                redirect('owners/Owner-dashbord');
            }
            // Init data
            $data = [
                'vehicle_id' => $vehicle_id,
                'licensePlate' => $vehicle->licensePlate,
                'vacantSeats' => $vehicle->vacantSeats,
                'totalSeats' => $vehicle->totalSeats,
                'ownerID' => $vehicle->ownerID,
                'cities' => $vehicle->cities,
                'schools' => $vehicle->schools,
                'features' => $vehicle->features,
                'licensePlate_err' => '',
                'vacantSeats_err' => '',
                'totalSeats_err' => '',
                'cities_err' => '',
                'schools_err' => '',
                'features_err' => ''
            ];
            // Load view
            $this->view('parents/Vehicle-edit', $data);
        }    

        public function assignDriver(){

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

                if ($vehicleID = $_SESSION['user_id']; // Assuming vehicleID is stored in session
                    $eligibleDrivers = $this->ownerModel->getEligibleDrivers($vehicleID);
                    )

                $data = [
                   'vehicleID' => trim($_POST['vehicle_id']),
                    'driverID' => $driverID,
                    'driverID_err'=> ''

                    /* 'vehicleID' => $vehicleID,
                   'vehicleID' => $_SESSION['user_id'],
                   'driverID' => trim($_POST['driverID'] ?? ''),*/

                ];

                // Validate driverID
                if(empty($data['driverID'])){
                    $data['driverID_err'] = 'Please select a driver';
                }

                 // Make sure no errors
                 if(empty($data['driverID_err'])){
                    // Validated

                    // Execute
                    if($this->ownerModel->assignDriver($data)){
                        // Redirect to manage
                        redirect('owners/Manage-vehicles');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('owners/add-drivers', $data);
                }

            } else {
       
                // Init data
                $data = [
                    'driverID_err' => ''
                ];

                // Load view
                $this->view('owners/add-drivers', $data);
        }
    }

}