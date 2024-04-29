<?php
#[\AllowDynamicProperties]
class Users extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $data = [];
        $this->view('users/index', $data);
    }

    public function parentRegister()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validate First Name
            if (empty($data['fname'])) {
                $data['fname_err'] = 'Please enter first name';
            }

            // Validate Last Name
            if (empty($data['lname'])) {
                $data['lname_err'] = 'Please enter last name';
            }

            // Validate Contact Number
            if (empty($data['contact_number'])) {
                $data['contact_number_err'] = 'Please enter contact number';
            } else if (strlen($data['contact_number']) != 10 && strlen($data['contact_number']) != 12) {
                $data['contact_number_err'] = 'Invalid Contact Number length, please use 07X XXX XXXX format or +94 XX XXX XXXX format';
            } else if (strlen($data['contact_number']) == 10 && !preg_match('/^0\d{9}$/', $data['contact_number'])) {
                $data['contact_number_err'] = 'Invalid Contact Number format, please use 0XX XXX XXXX format';
            } else if (strlen($data['contact_number']) == 12 && !preg_match('/^\+94\d{9}$/', $data['contact_number'])) {
                $data['contact_number_err'] = 'Invalid Contact Number format, please use +94 XX XXX XXXX format';
            }

            // Validate City
            if (empty($data['city'])) {
                $data['city_err'] = 'Please enter city';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['contact_number_err']) && empty($data['city_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Validated

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if ($this->userModel->registerParent($data)) {

                    $id = $this->userModel->getParentByEmail($data['email']);
                    $full_name = $data['fname'] . ' ' . $data['lname'];
                    // $this->verify_code($id->parentID, 'parent', $data['email'], $full_name);
                    $_SESSION['verify_id'] = $id->parentID;
                    $_SESSION['verify_type'] = 'parent';
                    $_SESSION['verify_email'] = $data['email'];
                    $_SESSION['verify_name'] = $full_name;

                    flash('register_success', 'You have Registered Successfully');
                    $this->view('users/registered');
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
                'confirm_password_err' => '',
                'cities' => $this->userModel->getCities()
            ];

            // Load view
            $this->view('users/parentRegister', $data);
        }
    }


    public function ownerRegister()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validate First Name
            if (empty($data['fname'])) {
                $data['fname_err'] = 'Please enter first name';
            }

            // Validate Last Name
            if (empty($data['lname'])) {
                $data['lname_err'] = 'Please enter last name';
            }

            // Validate Contact Number
            if (empty($data['contact_number'])) {
                $data['contact_number_err'] = 'Please enter contact number';
            } else if (strlen($data['contact_number']) != 10 && strlen($data['contact_number']) != 12) {
                $data['contact_number_err'] = 'Invalid Contact Number length, please use 07X XXX XXXX format or +94 XX XXX XXXX format';
            } else if (strlen($data['contact_number']) == 10 && !preg_match('/^0\d{9}$/', $data['contact_number'])) {
                $data['contact_number_err'] = 'Invalid Contact Number format, please use 07X XXX XXXX format';
            } else if (strlen($data['contact_number']) == 12 && !preg_match('/^\+94\d{9}$/', $data['contact_number'])) {
                $data['contact_number_err'] = 'Invalid Contact Number format, please use +94 XX XXX XXXX format';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['contact_number_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Validated

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if ($this->userModel->registerOwner($data)) {
                    $id = $this->userModel->getOwnerByEmail($data['email']);
                    $full_name = $data['fname'] . ' ' . $data['lname'];
                    $_SESSION['verify_id'] = $id->ownerID;
                    $_SESSION['verify_type'] = 'owner';
                    $_SESSION['verify_email'] = $data['email'];
                    $_SESSION['verify_name'] = $full_name;

                    flash('register_success', 'You have Registered Successfully');
                    $this->view('users/registered');
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



    public function driverRegister()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validate First Name
            if (empty($data['fname'])) {
                $data['fname_err'] = 'Please enter first name';
            }

            // Validate Last Name
            if (empty($data['lname'])) {
                $data['lname_err'] = 'Please enter last name';
            }

            // Validate Contact Number
            if (empty($data['contact_number'])) {
                $data['contact_number_err'] = 'Please enter contact number';
            } else if (strlen($data['contact_number']) != 10 && strlen($data['contact_number']) != 12) {
                $data['contact_number_err'] = 'Invalid Contact Number length, please use 07X XXX XXXX format or +94 XX XXX XXXX format';
            } else if (strlen($data['contact_number']) == 10 && !preg_match('/^0\d{9}$/', $data['contact_number'])) {
                $data['contact_number_err'] = 'Invalid Contact Number format, please use 07X XXX XXXX format';
            } else if (strlen($data['contact_number']) == 12 && !preg_match('/^\+94\d{9}$/', $data['contact_number'])) {
                $data['contact_number_err'] = 'Invalid Contact Number format, please use +94 XX XXX XXXX format';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Validate Address
            if (empty($data['address'])) {
                $data['address_err'] = 'Please enter address';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['fname_err']) && empty($data['lname_err']) && empty($data['address_err']) && empty($data['contact_number_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Validated

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if ($this->userModel->registerDriver($data)) {
                    // flash('register_success', 'You are registered and can log in');
                    // redirect('users/login');

                    $id = $this->userModel->getDriverByEmail($data['email']);
                    $full_name = $data['fname'] . ' ' . $data['lname'];
                    $_SESSION['verify_id'] = $id->driverID;
                    $_SESSION['verify_type'] = 'driver';
                    $_SESSION['verify_email'] = $data['email'];
                    $_SESSION['verify_name'] = $full_name;

                    flash('register_success', 'You have Registered Successfully');
                    $this->view('users/registered');
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

    public function adminRegister()
    {
        // Check if the user is logged in and is an admin
        if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin'){
            redirect('pages/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'contact_number' => trim($_POST['contact_number']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'first_name_err' => '',
                'last_name_err' => '',
                'email_err' => '',
                'contact_number_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate input
            if (empty($data['first_name'])) {
                $data['first_name_err'] = 'Please enter first name';
            }

            if (empty($data['last_name'])) {
                $data['last_name_err'] = 'Please enter last name';
            }

            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } elseif ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'Email is already taken';
            }

            // Validate Contact Number
            if (empty($data['contact_number'])) {
                $data['contact_number_err'] = 'Please enter contact number';
            } else if (strlen($data['contact_number']) != 10 && strlen($data['contact_number']) != 12) {
                $data['contact_number_err'] = 'Invalid Contact Number length, please use 07X XXX XXXX format or +94 XX XXX XXXX format';
            } else if (strlen($data['contact_number']) == 10 && !preg_match('/^0\d{9}$/', $data['contact_number'])) {
                $data['contact_number_err'] = 'Invalid Contact Number format, please use 07X XXX XXXX format';
            } else if (strlen($data['contact_number']) == 12 && !preg_match('/^\+94\d{9}$/', $data['contact_number'])) {
                $data['contact_number_err'] = 'Invalid Contact Number format, please use +94 XX XXX XXXX format';
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Passwords do not match';
            }

            // Make sure errors are empty
            if (empty($data['first_name_err']) && empty($data['last_name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['contact_number_err'])) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register Admin
                if ($this->userModel->adminRegister($data)) {
                    // flash('register_success', 'You are now registered as an Admin');
                    redirect('admins/manageAdmins');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/adminRegister', $data);
            }
        } else {
            // Load form
            $data = [
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'contact_number' => '',
                'password' => '',
                'confirm_password' => '',
                'first_name_err' => '',
                'last_name_err' => '',
                'email_err' => '',
                'contact_number_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            $this->view('users/adminRegister', $data);
        }
    }

    public function login()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            // print_r($_POST);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/email
            if ($this->userModel->findUserByEmail($data['email'])) {
                // User found
            } else {
                // User not found
                $data['email_err'] = 'No user found';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // Check if user is verified
                    if ($loggedInUser->codeVerified == 0) {

                        $_SESSION['verify_type'] = $loggedInUser->type;
                        if ($loggedInUser->type == 'parent') {
                            $id = $this->userModel->getParentByEmail($data['email']);
                            $_SESSION['verify_id'] = $id->parentID;
                        } else if ($loggedInUser->type == 'owner') {
                            $id = $this->userModel->getOwnerByEmail($data['email']);
                            $_SESSION['verify_id'] = $id->ownerID;
                        } else if ($loggedInUser->type == 'driver') {
                            $id = $this->userModel->getDriverByEmail($data['email']);
                            $_SESSION['verify_id'] = $id->driverID;
                        }

                        $full_name = $loggedInUser->firstName . ' ' . $loggedInUser->lastName;
                        $_SESSION['verify_email'] = $loggedInUser->email;
                        $_SESSION['verify_name'] = $full_name;

                        $this->view('users/registered');
                    } else {
                        // Create Session
                        $this->createUserSession($loggedInUser);
                    }
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

    public function createUserSession($user)
    {
        // $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_fname'] = $user->firstName;
        $_SESSION['user_type'] = $user->type;

        if ($user->type == 'parent')
            $_SESSION['user_id'] = $user->parentID;
        else if ($user->type == 'owner')
            $_SESSION['user_id'] = $user->ownerID;
        else if ($user->type == 'driver')
            $_SESSION['user_id'] = $user->driverID;
        else if ($user->type == 'admin')
            $_SESSION['user_id'] = $user->adminID;
        redirect('pages/index');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_fname']);
        unset($_SESSION['user_type']);

        unset($_SESSION['childID']);
        unset($_SESSION['childSchool']);
        unset($_SESSION['childGrade']);
        unset($_SESSION['childName']);

        session_destroy();
        redirect('users/login');
    }

    public function isParentLoggedIn()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'parent') {
            return true;
        } else {
            return false;
        }
    }

    public function isOwnerLoggedIn()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'owner') {
            return true;
        } else {
            return false;
        }
    }

    public function isDriverLoggedIn()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'driver') {
            return true;
        } else {
            return false;
        }
    }

    public function isAdminLoggedIn()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function registered()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $verify_id = $_SESSION['verify_id'];
            $verify_type = $_SESSION['verify_type'];
            $verify_email = $_SESSION['verify_email'];
            $verify_name = $_SESSION['verify_name'];

            $this->verify_code($verify_id, $verify_type, $verify_email, $verify_name);
            $this->view('users/verify');
        } else {
            $this->view('users/registered');
        }
    }

    public function verify()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['verify_id']) && isset($_SESSION['verify_email']) && isset($_SESSION['verify_type'])) {
                if (isset($_POST['code'])) {

                    $code = trim(htmlspecialchars($_POST['code']));
                    $id = $_SESSION['verify_id'];
                    $type = $_SESSION['verify_type'];
                    $email = $_SESSION['verify_email'];

                    if ($this->checkVerificationCode($id, $type, $code)) {
                        
                        if ($type == 'parent') {
                            $this->userModel->setParentVerified($id);
                            $loggedInUser = $this->userModel->getParentByEmail($email);
                        } else if ($type == 'owner') {
                            $this->userModel->setOwnerVerified($id);
                            $loggedInUser = $this->userModel->getOwnerByEmail($email);
                        } else if ($type == 'driver') {
                            $this->userModel->setDriverVerified($id);
                            $loggedInUser = $this->userModel->getDriverByEmail($email);
                        }

                        if ($loggedInUser) {
                            $loggedInUser->type = $type;
                            $this->createUserSession($loggedInUser);
                            redirect('pages/index');
                        }
                    } else {
                        $data['code_err'] = 'Invalid verification code';
                        $this->view('users/verify', $data);
                    }
                } else {
                    $data['code_err'] = 'Please enter verification code';
                    $this->view('users/verify', $data);
                }
            } else {
                redirect('users/login');
            }
        } else {
            $data = [
                'code_err' => '',
            ];
            $this->view('users/verify', $data);
        }
    }

    public function checkVerificationCode($user_id, $type, $code)
    {
        $verify = $this->userModel->getVerificationCode($user_id, $type);
        if ($verify) {
            if ($verify->code == $code) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    
    private function verify_code($user_id, $type, $receiver, $receiver_name)
    {
        $this->userModel->generateVerificationCode($user_id, $type);
        $code = $this->userModel->getVerificationCode($user_id, $type);
        $date = date('d M Y');
        $subject = 'EduPick Verification Code';
        // $body_string = 'Your verification code is: ' . $code->code;
        $body_string = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta http-equiv="X-UA-Compatible" content="ie=edge" />
            <title>EduPick OTP Email</title>

            <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
            rel="stylesheet"
            />
        </head>
        <body
            style="
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: #ffffff;
            font-size: 14px;
            "
        >
            <div
            style="
                max-width: 680px;
                margin: 0 auto;
                padding: 45px 30px 60px;
                background: rgb(255,255,255);
                background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(214,244,255,1) 35%, rgba(8,159,189,1) 100%); 
                background-repeat: no-repeat;
                background-size: 800px 452px;
                background-position: top center;
                font-size: 14px;
                color: #434343;
            "
            >
            <header>
                <table style="width: 100%;">
                <tbody>
                    <tr style="height: 0;">
                    <td>
                        <h1 style="color: black;"><span style="color: #e44d26;">Edu</span>Pick</h2>
                    </td>
                    <td style="text-align: right;">
                        <span
                        style="font-size: 16px; line-height: 30px; color: #ffffff;"
                        >' . $date . '</span
                        >
                    </td>
                    </tr>
                </tbody>
                </table>
            </header>

            <main>
                <div
                style="
                    margin: 0;
                    margin-top: 70px;
                    padding: 92px 30px 115px;
                    background: #ffffff;
                    border-radius: 30px;
                    text-align: center;
                "
                >
                <div style="width: 100%; max-width: 489px; margin: 0 auto;">
                    <h1
                    style="
                        margin: 0;
                        font-size: 24px;
                        font-weight: 500;
                        color: #1f1f1f;
                    "
                    >
                    EduPick Verification Code
                    </h1>
                    <p
                    style="
                        margin: 0;
                        margin-top: 17px;
                        font-size: 16px;
                        font-weight: 500;
                    "
                    >
                    Hey ' . $receiver_name . ',
                    </p>
                    <p
                    style="
                        margin: 0;
                        margin-top: 17px;
                        font-weight: 500;
                        letter-spacing: 0.56px;
                    "
                    >
                    Thank you for choosing EduPick School Transport Management System. Use the following Verification Code
                    to verify your email address.<br>Do not share this code with anyone.
                    </p>
                    <p
                    style="
                        margin: 0;
                        margin-top: 60px;
                        font-size: 40px;
                        font-weight: 600;
                        letter-spacing: 25px;
                        color: #e44d26;
                    "
                    >
                    ' . $code->code . '
                    </p>
                </div>
                </div>

                <p
                style="
                    max-width: 400px;
                    margin: 0 auto;
                    margin-top: 90px;
                    text-align: center;
                    font-weight: 500;
                    color: #8c8c8c;
                "
                >
                Need help? Ask at
                <a
                    href="mailto:info.edupick@gmail.com"
                    style="color: #499fb6; text-decoration: none;"
                    >info.edupick@gmail.com</a
                >
                </p>
            </main>
            </div>
        </body>
        </html>
        ';
        send_email($receiver, $receiver_name,  $subject, $body_string);
    }
}
