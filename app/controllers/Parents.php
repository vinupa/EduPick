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
            $data = [];
            $this->view('parents/index', $data);
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
                    'grade_err' => ''
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
                    'grade_err' => ''
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
                    'grade_err' => ''
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
                    'school' => $child->school,
                    'grade' => $child->grade,
                    'parentID' => $child->parentID,
                    'firstName_err' => '',
                    'lastName_err' => '',
                    'school_err' => '',
                    'grade_err' => ''
                ];

                // Load view
                $this->view('parents/updateChild', $data);
                
            }
        }