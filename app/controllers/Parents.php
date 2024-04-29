<?php
    #[\AllowDynamicProperties]
    
    class Parents extends Controller {

        public function __construct(){
            if(!isset($_SESSION['user_id'])){
                redirect('users/login');
            } elseif($_SESSION['user_type'] != 'parent'){
                redirect('users/login');
            }

            $this->parentModel = $this->model('Parent_');
        }

        public function index(){
            redirect('parents/manageChildren');
        }

        public function manageChildren(){
            $data = [
                'children' => $this->parentModel->getChildren($_SESSION['user_id'])
            ];
            $this->view('parents/manageChildren', $data);
        }

        public function addChild(){

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

                $data = [
                    'fname' => trim($_POST['first_name']),
                    'lname' => trim($_POST['last_name']),
                    'school' => trim($_POST['school'] ?? ''),
                    'grade' => trim($_POST['grade']),
                    'parentID' => $_SESSION['user_id'],
                    'fname_err' => '',
                    'lname_err' => '',
                    'school_err' => '',
                    'grade_err' => '',                    
                    'schools' => $this->parentModel->getSchools()
                ];

                // Validate first name
                if(empty($data['fname'])){
                    $data['fname_err'] = 'Please enter first name';
                }

                // Validate last name
                if(empty($data['lname'])){
                    $data['lname_err'] = 'Please enter last name';
                }

                // Validate school
                if(empty($data['school'])){
                    $data['school_err'] = 'Please select school';
                }

                // Validate grade
                if(empty($data['grade'])){
                    $data['grade_err'] = 'Please enter grade';
                } elseif($data['grade'] < 1 || $data['grade'] > 13){
                    $data['grade_err'] = 'Please enter a valid grade';
                }

                // Make sure no errors
                if(empty($data['fname_err']) && empty($data['lname_err']) && empty($data['school_err']) && empty($data['grade_err'])){
                    // Validated

                    // Execute
                    if($this->parentModel->addChild($data)){
                        // Redirect to manage
                        redirect('parents/manageChildren');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('parents/addChild', $data);
                }

            } else {
                // Init data
                $data = [
                    'fname' => '',
                    'lname' => '',
                    'school' => '',
                    'grade' => '',
                    'parentID' => '',
                    'fname_err' => '',
                    'lname_err' => '',
                    'school_err' => '',
                    'grade_err' => '',
                    'schools' => $this->parentModel->getSchools()
                ];

                // Load view
                $this->view('parents/addChild', $data);
        }
    }


        public function removeChild($child_id){
            if($this->parentModel->removeChild($child_id)){
                redirect('parents/manageChildren');
            } else {
                die('Something went wrong');
            }
        }

        public function updateChildPost(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

                if (isset($_POST['school'])) {
                    $school = trim($_POST['school']);
                } else {
                    $school = null;
                }

                $data = [
                    'child_id' => trim($_POST['child_id']),
                    'firstName' => trim($_POST['first_name']),
                    'lastName' => trim($_POST['last_name']),
                    'school' => $school,
                    'grade' => trim($_POST['grade']),
                    'parentID' => $_SESSION['user_id'],
                    'firstName_err' => '',
                    'lastName_err' => '',
                    'school_err' => '',
                    'grade_err' => '',
                    'schools' => $this->parentModel->getSchools()
                ];

                // Validate first name
                if(empty($data['firstName'])){
                    $data['firstName_err'] = 'Please enter first name';
                }

                // Validate last name
                if(empty($data['lastName'])){
                    $data['lastName_err'] = 'Please enter last name';
                }

                // Validate school
                if(empty($data['school'])){
                    $data['school_err'] = 'Please select school';
                }

                // Validate grade
                if(empty($data['grade'])){
                    $data['grade_err'] = 'Please enter grade';
                } elseif($data['grade'] < 1 || $data['grade'] > 13){
                    $data['grade_err'] = 'Please enter a valid grade';
                }

                // Make sure no errors
                if(empty($data['firstName_err']) && empty($data['lastName_err']) && empty($data['school_err']) && empty($data['grade_err'])){
                    // Validated

                    // Execute
                    if($this->parentModel->updateChild($data)){
                        // Redirect to manage
                        redirect('parents/manageChildren');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('parents/updateChild', $data);
                }

            }
        }

        public function updateChild($child_id){
            // Get child data from child id and fill the form
            $child = $this->parentModel->getChild($child_id);
            if($child->parentID != $_SESSION['user_id']){
                redirect('parents/manageChildren');
            }
            // Init data
            $data = [
                'child_id' => $child_id,
                'firstName' => $child->firstName,
                'lastName' => $child->lastName,
                'school' => $child->schoolId,
                'grade' => $child->grade,
                'parentID' => $child->parentID,
                'firstName_err' => '',
                'lastName_err' => '',
                'school_err' => '',
                'grade_err' => '',
                'schools' => $this->parentModel->getSchools()
            ];
            // Load view
            $this->view('parents/updateChild', $data);
        }
        
        public function selectChild(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

                $data = [
                    'childID' => trim($_POST['child'])
                ];

                // Validate childID
                if(empty($data['childID'])){
                    redirect('parents/selectChild');
                } else {
                    // Execute
                    $child = $this->parentModel->getChild($data['childID']);
                    if($child){
                        // Redirect to manage
                        // redirect('parents/manageChildren');
                        $_SESSION['childSchoolId'] = $child->schoolId;
                        $_SESSION['childGrade'] = $child->grade;
                        $_SESSION['childID'] = $child->childID;
                        $_SESSION['childName'] = $child->firstName . ' ' . $child->lastName;

                        redirect('parents/searchVehicles');
                    } else {
                        die('Something went wrong');
                    }
                }
            } else {
                $data = [
                    'children' => $this->parentModel->getUnassignedChildren($_SESSION['user_id'])
                ];
                $this->view('parents/selectChild', $data);
            }
        }

        public function searchVehicles(){
            if(!isset($_SESSION['childID'])){
                redirect('parents/selectChild');
            }

            if($this->parentModel->haspendingRequest($_SESSION['childID'])){
                redirect('parents/pendingRequest');
            }

            $city = $this->parentModel->getCity($_SESSION['user_id']);
            $school = $this->parentModel->getSchool($_SESSION['childSchoolId']);
            $vehicles = $this->parentModel->getVehicles($city->cityId, $_SESSION['childSchoolId']);
            
            $data = [
                'city' => $city->name,
                'school' => $school->name,
                'vehicles' => $vehicles
            ];
            $this->view('parents/searchVehicles', $data);
        }

        public function requestVehicle($vehicle_id){
            if($this->parentModel->requestVehicle($vehicle_id, $_SESSION['childID'])){
                redirect('parents/pendingRequest');
            } else {
                die('Something went wrong');
            }
        }

        public function pendingRequest(){

            if(!$this->parentModel->haspendingRequest($_SESSION['childID'])){
                redirect('parents/searchVehicles');
            }

            $vehicle = $this->parentModel->pendingRequest($_SESSION['childID']);
            $driver = $this->parentModel->getDriver($vehicle->driverId);
            
            $data = [
                'vehicle' => $vehicle,
                'driver' => $driver
            ];
            $this->view('parents/pendingRequest', $data);
        }

        public function cancelRequest($child_id){
            if($this->parentModel->cancelRequest($child_id)){
                redirect('parents/pendingRequest');
            } else {
                die('Something went wrong');
            }
        }

        public function manageVehicles(){
            $data = [
                'children' => $this->parentModel->getAssignedChildren($_SESSION['user_id'])
            ];
            $this->view('parents/manageVehicles', $data);
        }

        public function childAttending($child_id){
            if($this->parentModel->childAttending($child_id)){
                redirect('parents/manageVehicles');
            } else {
                die('Something went wrong');
            }
        }

        public function childAbsent($child_id){
            if($this->parentModel->childAbsent($child_id)){
                redirect('parents/manageVehicles');
            } else {
                die('Something went wrong');
            }
        }

        public function disconnectVehicle($child_id){
            if($this->parentModel->childAttending($child_id)){
                if($this->parentModel->disconnectVehicle($child_id)){
                    redirect('parents/manageVehicles');
                } else {
                    die('Something went wrong');
                }   
            } else {
                die('Something went wrong');
            }
        }

        public function reportIncident(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

                if (isset($_POST['vehicle'])) {
                    $vehicle = trim($_POST['vehicle']);
                } else {
                    $vehicle = null;
                }

                $data = [
                    'parentID' => $_SESSION['user_id'],
                    'vehicleID' => $vehicle,
                    'title' => trim($_POST['title']),
                    'description' => trim($_POST['description']),
                    'vehicle_err' => ''
                ];

                if(empty($data['vehicleID'])){
                    $data['vehicle_err'] = 'Please select associated vehicle';
                }

                if(!empty($data['vehicle_err'])){
                    $data['vehicles'] = $this->parentModel->vehiclesListComplaint($_SESSION['user_id']);
                    $this->view('parents/reportIncident', $data);
                    return;
                }

                if($this->parentModel->reportIncident($data)){
                    redirect('parents/incidentReports');
                } else {
                    die('Something went wrong');
                }
            }
            $data = [
                'title' => '',
                'description' => '',
                'vehicles' => $this->parentModel->vehiclesListComplaint($_SESSION['user_id']),
                'vehicle_err' => ''
            ];
            $this->view('parents/reportIncident', $data);
        }

        public function incidentReports(){
            $data = [
                'reports' => $this->parentModel->getIncidentReports($_SESSION['user_id'])
            ];
            $this->view('parents/incidentReports', $data);
        }

        public function reportResolved($incidentID){
            if($this->parentModel->reportResolved($incidentID)){
                redirect('parents/incidentReports');
            } else {
                die('Something went wrong');
            }
        }

        public function reportDelete($incidentID){
            if($this->parentModel->reportDelete($incidentID)){
                redirect('parents/incidentReports');
            } else {
                die('Something went wrong');
            }
        }
}