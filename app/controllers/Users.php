<?php
    #[\AllowDynamicProperties]
    class Users extends Controller{

        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function index(){
            $data = [];
            $this->view('users/index', $data);
        }

        public function parentRegister(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

                if (isset($_POST['nearest_city'])) {
                    $nearest_city = trim($_POST['nearest_city']);
                } else {
                    $nearest_city = null;
                }

                $data = [
                    'fname' => trim($_POST['first_name']),
                    'lname' => trim($_POST['last_name']),
                    'contact_number' => trim($_POST['mobile_number']),
                    'city' => $nearest_city,
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm-password']),
                    'fname_err' => '',
                    'lname_err' => '',
                    'contact_number_err' => '',
                    'city_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                } else {
                    // Check email
                    if($this->userModel->findParentByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                // Validate First Name
                if(empty($data['fname'])){
                    $data['fname_err'] = 'Please enter first name';
                }

                // Validate Last Name
                if(empty($data['lname'])){
                    $data['lname_err'] = 'Please enter last name';
                }

                // Validate Contact Number
                if(empty($data['contact_number'])){
                    $data['contact_number_err'] = 'Please enter contact number';
                }

                // Validate City
                if(empty($data['city'])){
                    $data['city_err'] = 'Please enter city';
                }

                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                } elseif(strlen($data['password']) < 6){
                    $data['password_err'] = 'Password must be at least 6 characters';
                }

                // Validate Confirm Password
                if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = 'Please confirm password';
                } else {
                    if($data['password'] != $data['confirm_password']){
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                }

                // Make sure errors are empty
                if(empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['contact_number_err']) && empty($data['city_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                    // Validated

                    // Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Register User
                    if($this->userModel->registerParent($data)){
                        flash('register_success', 'You are Registered and can Log in');
                        redirect('users/login');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('users/parentRegister', $data);
                }

            } else {
                // Init data
                $data = [
                    'fname' => '',
                    'lname' => '',
                    'contact_number' => '',
                    'city' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'fname_err' => '',
                    'lname_err' => '',
                    'contact_number_err' => '',
                    'city_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                // Load view
                $this->view('users/parentRegister', $data);
            }
        }


        public function ownerRegister(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

                $data = [
                    'fname' => trim($_POST['first_name']),
                    'lname' => trim($_POST['last_name']),
                    'contact_number' => trim($_POST['mobile_number']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm-password']),
                    'fname_err' => '',
                    'lname_err' => '',
                    'contact_number_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                } else {
                    // Check email
                    if($this->userModel->findOwnerByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                // Validate First Name
                if(empty($data['fname'])){
                    $data['fname_err'] = 'Please enter first name';
                }

                // Validate Last Name
                if(empty($data['lname'])){
                    $data['lname_err'] = 'Please enter last name';
                }

                // Validate Contact Number
                if(empty($data['contact_number'])){
                    $data['contact_number_err'] = 'Please enter contact number';
                }

                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                } elseif(strlen($data['password']) < 6){
                    $data['password_err'] = 'Password must be at least 6 characters';
                }

                // Validate Confirm Password
                if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = 'Please confirm password';
                } else {
                    if($data['password'] != $data['confirm_password']){
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                }

                // Make sure errors are empty
                if(empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['contact_number_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                    // Validated

                    // Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Register User
                    if($this->userModel->registerOwner($data)){
                        flash('register_success', 'You are registered and can log in');
                        redirect('users/login');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('users/ownerRegister', $data);
                }
            } else {
                // Init data
                $data = [
                    'fname' => '',
                    'lname' => '',
                    'contact_number' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'fname_err' => '',
                    'lname_err' => '',
                    'contact_number_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                // Load view
                $this->view('users/ownerRegister', $data);
            }
        }

        public function driverRegister(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

                $data = [
                    'fname' => trim($_POST['first_name']),
                    'lname' => trim($_POST['last_name']),
                    'contact_number' => trim($_POST['mobile_number']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm-password']),
                    'address' => trim($_POST['address']),
                    'fname_err' => '',
                    'lname_err' => '',
                    'contact_number_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'address_err' => ''
                ];

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                } else {
                    // Check email
                    if($this->userModel->findDriverByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                // Validate First Name
                if(empty($data['fname'])){
                    $data['fname_err'] = 'Please enter first name';
                }

                // Validate Last Name
                if(empty($data['lname'])){
                    $data['lname_err'] = 'Please enter last name';
                }

                // Validate Contact Number
                if(empty($data['contact_number'])){
                    $data['contact_number_err'] = 'Please enter contact number';
                }

                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                } elseif(strlen($data['password']) < 6){
                    $data['password_err'] = 'Password must be at least 6 characters';
                }

                // Validate Confirm Password
                if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = 'Please confirm password';
                } else {
                    if($data['password'] != $data['confirm_password']){
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                }

                // Validate Address
                if(empty($data['address'])){
                    $data['address_err'] = 'Please enter address';
                }

                // Make sure errors are empty
                if(empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['address_err']) && empty($data['contact_number_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                    // Validated

                    // Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Register User
                    if($this->userModel->registerDriver($data)){
                        flash('register_success', 'You are registered and can log in');
                        redirect('users/login');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('users/driverRegister', $data);
                }
            } else {
                // Init data
                $data = [
                    'fname' => '',
                    'lname' => '',
                    'contact_number' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'address' => '',
                    'fname_err' => '',
                    'lname_err' => '',
                    'contact_number_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'address_err' => ''
                ];

                // Load view
                $this->view('users/driverRegister', $data);
            }
        }

        public function login(){
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
                print_r($_POST);

                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',
                ];

                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter email';
                }

                // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                }

                // Check for user/email
                if($this->userModel->findUserByEmail($data['email'])){
                    // User found
                } else {
                    // User not found
                    $data['email_err'] = 'No user found';
                }

                // Make sure errors are empty
                if(empty($data['email_err']) && empty($data['password_err'])){
                    // Validated
                    // Check and set logged in user
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                    if($loggedInUser){
                        // Create Session
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['password_err'] = 'Password incorrect';

                        $this->view('users/login', $data);
                    }
                } else {
                    // Load view with errors
                    $this->view('users/login', $data);
                }

            } else {
                // Init data
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''
                ];

                // Load view
                $this->view('users/login', $data);
                // echo $_SESSION['user_id'];
                // echo $_SESSION['user_type'];
            }
        }

        public function createUserSession($user){
            // $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_fname'] = $user->firstName;
            $_SESSION['user_type'] = $user->type;

            if($user->type == 'parent')
                $_SESSION['user_id'] = $user->parentID;
            else if($user->type == 'owner')
                $_SESSION['user_id'] = $user->ownerID;
            else if($user->type == 'driver')
                $_SESSION['user_id'] = $user->driverID;
            else if($user->type == 'admin')
                $_SESSION['user_id'] = $user->adminID;
            redirect('pages/index');
        }

        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_fname']);
            unset($_SESSION['user_type']);
            session_destroy();
            redirect('users/login');
        }

        public function isParentLoggedIn(){
            if(isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'parent'){
                return true;
            } else {
                return false;
            }
        }

        public function isOwnerLoggedIn(){
            if(isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'owner'){
                return true;
            } else {
                return false;
            }
        }

        public function isDriverLoggedIn(){
            if(isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'driver'){
                return true;
            } else {
                return false;
            }
        }

        public function isAdminLoggedIn(){
            if(isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'admin'){
                return true;
            } else {
                return false;
            }
        }

    }