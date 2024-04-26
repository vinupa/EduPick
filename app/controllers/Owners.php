<?php
#[\AllowDynamicProperties]

class Owners extends Controller
{

    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('users/login');
        } elseif ($_SESSION['user_type'] != 'owner') {
            redirect('users/login');
        }

        $this->ownerModel = $this->model('Owner_');
    }

    public function index()
    {
        $data = '';
        $this->view('owners/index', $data);
    }

    public function manageVehicles()
    {
        $data = [
            'vehicles' => $this->ownerModel->getAllVehicles($_SESSION['user_id'])
        ];
        $this->view('owners/manageVehicles', $data);
    }

    public function addVehicle()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if a file is uploaded
            $vehicleImagePath = $this->upload_image("image_vehicle", $_FILES, "vehicle\\vehicleImage\\");
            $registrationDocPath = $this->upload_pdf("registrationDoc", $_FILES, "vehicle\\registrationDoc\\");
            $emissionsReportPath = $this->upload_pdf("emissionsReport", $_FILES, "vehicle\\emissionsReport\\");

            // Sanitize and validate other form data
            $data = [
                'owner_id' => $_SESSION['user_id'],
                'licensePlate1' => trim(htmlspecialchars($_POST['licensePlate1'])),
                'licensePlate2' => trim(htmlspecialchars($_POST['licensePlate2'])),
                'licensePlate' => trim(htmlspecialchars($_POST['licensePlate1'])) . ' - ' . trim(htmlspecialchars($_POST['licensePlate2'])),
                'model' => trim(htmlspecialchars($_POST['model'])),
                'modelYear' => trim(htmlspecialchars($_POST['modelYear'])),
                'ac' => isset($_POST['ac']) ? '1' : '0',
                'highroof' => isset($_POST['highroof']) ? '1' : '0',
                'totalSeats' => trim(htmlspecialchars($_POST['totalSeats'])),
                'vacantSeats' => trim(htmlspecialchars($_POST['vacantSeats'])),
                'vehicleImage' => $vehicleImagePath,
                'registrationDoc' => $registrationDocPath,
                'emissionsReport' => $emissionsReportPath,
                'city' => $_POST['city'],
                'school' => $_POST['school'],
                'data_err' => '',
            ];

            // Validate form data
            if (empty($data['licensePlate1']) || empty($data['licensePlate2'])) {
                $data['data_err'] = 'Please enter license plate number';
            }
            if (empty($data['model'])) {
                $data['data_err'] = 'Please enter vehicle model';
            }
            if (empty($data['totalSeats'])) {
                $data['data_err'] = 'Please enter total seats';
            }
            if (empty($data['vacantSeats'])) {
                $data['data_err'] = 'Please enter vacant seats';
            }
            if (empty($data['city'])) {
                $data['data_err'] = 'Please select at least one city';
            }
            if (empty($data['school'])) {
                $data['data_err'] = 'Please select at least one school';
            }

            if ($data['vacantSeats'] > $data['totalSeats']) {
                $data['data_err'] = 'Vacant seats must be less than or equal to total seats';
            }

            // Make sure there are no errors
            if (empty($data['data_err'])) {
                // Validation passed
                //Execute
                if ($this->ownerModel->addVehicle($data)) {
                    redirect('owners/manageVehicles');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $data['city'] = $this->ownerModel->getCities();
                $data['school'] = $this->ownerModel->getSchools();
                $this->view('owners/addVehicle', $data);
            }
        } else {
            $data = [
                'city' => $this->ownerModel->getCities(),
                'school' => $this->ownerModel->getSchools(),
                'data_err' => ''
            ];
            $this->view('owners/addVehicle', $data);
        }
    }
   
    public function driverRequests()
    {
        $data = [
            'requests' => $this->ownerModel->getDriverRequests($_SESSION['user_id'])
        ];
        $this->view('owners/driverRequests', $data);
    }

    public function acceptRequest($request_id){
        if($this->ownerModel->acceptRequest($request_id)){
            redirect('owners/manageVehicles');
        } else {
            die('Something went wrong');
        }
    }

    public function declineRequest($request_id){
        if($this->ownerModel->declineRequest($request_id)){
            redirect('owners/manageVehicles');
        } else {
            die('Something went wrong');
        }
    }



    
    public function childRequests()
    {
        $data = [
            'childrequests' => $this->ownerModel->getChildRequests($_SESSION['user_id'])
        ];
        $this->view('owners/childRequests', $data);
    }

    public function acceptChildRequest($parent_id){
        if($this->ownerModel->acceptChildRequest($parent_id)){
            redirect('owners/viewParents');
        } else {
            die('Something went wrong');
        }
    }

    public function declineChildRequest($parent_id){
        if($this->ownerModel->declineChildRequest($parent_id)){
            redirect('owners/viewParents');
        } else {
            die('Something went wrong');
        }
    }


   /* public function viewParents()
    {
       $post =  $this->ownerModel->getAllParents($_SESSION['user_id']);
       $child =  $this->ownerModel->getChild(2);

        $data = [
            'parents' => $post,
            'child' =>$child
        ];
        $this->view('owners/viewParents', $data);
    }*/

    public function viewParents()
    {
        $data = [
            'parents' => $this->ownerModel->getAllParents($_SESSION['user_id'])
         ];
         $this->view('owners/viewParents', $data);
     }


    public function editVehicle($id)
    {
        $post = $this->ownerModel->getvehicleById($id);
        $city = $this->ownerModel->getcityById($post->vehicleId);
        $cityname = $this->ownerModel->getcitynameById($city->cityId);
        $coveredCities = $this->ownerModel->getCities();
        $coveredSchools = $this->ownerModel->getSchools();
        

        $data = [
            'vehicle'=> $post,
            'city'=> $cityname,
            'coveredCities' => $coveredCities,
            'coveredSchools' => $coveredSchools,
            'id' =>$id
        ];
        $this->view('owners/updateVehicle',$data);
    }


    public function updateSchools($id)
    {
        $post = $this->ownerModel->getvehicleById($id);
        $school = $this->ownerModel->getschoolById($post->vehicleId);
        $schoolname = $this->ownerModel->getschoolnameById($school->schoolId);
        $coveredSchools = $this->ownerModel->getSchools();

        $data = [
            'vehicle'=> $post,
            'school'=> $schoolname,
            'coveredSchools' => $coveredSchools
        ];
        $this->view('owners/updateVehicle',$data);
    }

   
    /*public function viewParents()
    {
        $data = [
            'parents' => $this->ownerModel->getAllParents($_SESSION['user_id'])
        ];
        $this->view('owners/viewParents', $data); 
    }*/

    public function removeChild($child_id){
        if($this->ownerModel->removeChild($child_id)){
            redirect('owners/viewParents');
        } else {
            die('Something went wrong');
        }
    }



    public function viewDrivers()
    {
        $data = [
            'drivers' => $this->ownerModel->getAllDrivers($_SESSION['user_id'])
        ];
        $this->view('owners/viewDrivers', $data); 
    }
    

    public function updateVehicle($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if a file is uploaded
            // $vehicleImagePath = $this->upload_image("image_vehicle", $_FILES, "vehicle\\vehicleImage\\");
            // $registrationDocPath = $this->upload_pdf("registrationDoc", $_FILES, "vehicle\\registrationDoc\\");
            // $emissionsReportPath = $this->upload_pdf("emissionsReport", $_FILES, "vehicle\\emissionsReport\\");

            // Sanitize and validate other form data
            $data = [
                'owner_id' => $_SESSION['user_id'],
                'vehicle_id' => $id,
                'licensePlate1' => trim(htmlspecialchars($_POST['licensePlate1'])),
                'licensePlate2' => trim(htmlspecialchars($_POST['licensePlate2'])),
                'licensePlate' => trim(htmlspecialchars($_POST['licensePlate1'])) . ' - ' . trim(htmlspecialchars($_POST['licensePlate2'])),
                'model' => trim(htmlspecialchars($_POST['model'])),
                'modelYear' => trim(htmlspecialchars($_POST['modelYear'])),
                'ac' => isset($_POST['ac']) ? '1' : '0',
                'highroof' => isset($_POST['highroof']) ? '1' : '0',
                'totalSeats' => trim(htmlspecialchars($_POST['totalSeats'])),
                'vacantSeats' => trim(htmlspecialchars($_POST['vacantSeats'])),
                //'vehicleImage' => $vehicleImagePath,
               // 'registrationDoc' => $registrationDocPath,
                //'emissionsReport' => $emissionsReportPath,
                'city' => $_POST['city'],
                'school' => $_POST['school'],
                'data_err' => '',
            ];

            // Validate form data
            if (empty($data['licensePlate1']) || empty($data['licensePlate2'])) {
                $data['data_err'] = 'Please enter license plate number';
            }
            if (empty($data['model'])) {
                $data['data_err'] = 'Please enter vehicle model';
            }
            if (empty($data['totalSeats'])) {
                $data['data_err'] = 'Please enter total seats';
            }
            if (empty($data['vacantSeats'])) {
                $data['data_err'] = 'Please enter vacant seats';
            }
            if (empty($data['city'])) {
                $data['data_err'] = 'Please select at least one city';
            }
            if (empty($data['school'])) {
                $data['data_err'] = 'Please select at least one school';
            }

            if ($data['vacantSeats'] > $data['totalSeats']) {
                $data['data_err'] = 'Vacant seats must be less than or equal to total seats';
            }

            // Make sure there are no errors
            if (empty($data['data_err'])) {
                // Validation passed
                //Execute
                if ($this->ownerModel->updateVehicle($data)) {
                    redirect('owners/manageVehicles');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                // $data['city'] = $this->ownerModel->getCities();
                // $data['school'] = $this->ownerModel->getSchools();
                $this->view('owners/addVehicle', $data);
            }
        } else {
            $data = [
                'city' => $this->ownerModel->getCities(),
                'school' => $this->ownerModel->getSchools(),
                'data_err' => ''
            ];
            $this->view('owners/addVehicle', $data);
        }
    }

    public function viewChild($owner_id)
    {
        $data = [
            'child' => $this->ownerModel->getChild($owner_id)
         ];
         $this->view('owners/viewParents', $data);
     }
  
   
}
