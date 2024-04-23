<?php
#[\AllowDynamicProperties]

class Drivers extends Controller
{

    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('users/login');
        } elseif ($_SESSION['user_type'] != 'driver') {
            redirect('users/login');
        }

        $this->driverModel = $this->model('Driver_');
    }

    public function index()
    {
        $driver = $this->driverModel->getDriver($_SESSION['user_id']);

        $formState = $driver->formState;
        $pendingState = $driver->pendingState;
        $approvedState = $driver->approvedState;

        if ($approvedState == 0 && $pendingState == 0 && $formState == 0) {
            redirect('drivers/driverForm');
        } elseif ($approvedState == 0 && $pendingState == 1 && $formState == 1) {
            redirect('drivers/driverPending');
        } elseif ($approvedState == 1 && $pendingState == 0 && $formState == 1) {
            redirect('drivers/driverDashboard');
        }
    }

    public function driverDashboard()
    {
        if(!$this->driverModel->isDriverConnected($_SESSION['user_id'])){
            redirect('drivers/findVehicles');
        }

        $data = [];
        $this->view('drivers/driverDashboard', $data);
    }

    public function driverForm()
    {
        $data = [
            'driver' => $this->driverModel->getDriver($_SESSION['user_id']),
            'data_err' => ''
        ];
        $this->view('drivers/driverForm', $data);
    }

    public function driverForm_post()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if a file is uploaded
            $profilePhotoPath = $this->upload_image("profilePhoto", $_FILES, "driver\profilePhoto\\");
            $nicFrontPath = $this->upload_image("nicFront", $_FILES, "driver\\nicFront\\");
            $nicBackPath = $this->upload_image("nicBack", $_FILES, "driver\\nicBack\\");
            $licenseFrontPath = $this->upload_image("licenseFront", $_FILES, "driver\licenseFront\\");
            $licenseBackPath = $this->upload_image("licenseBack", $_FILES, "driver\licenseBack\\");
            $policeReportPath = $this->upload_pdf("policeReport", $_FILES, "driver\policeReport\\");
            $proofResidencePath = $this->upload_pdf("proofResidence", $_FILES, "driver\proofResidence\\");

            // Sanitize and validate other form data
            $data = [
                'driver_id' => $_SESSION['user_id'],
                'nic' => trim(htmlspecialchars($_POST['nic'])),
                'nicFront' => $nicFrontPath,
                'nicBack' => $nicBackPath,
                'licenseFront' => $licenseFrontPath,
                'licenseBack' => $licenseBackPath,
                'policeReport' => $policeReportPath,
                'profilePhoto' => $profilePhotoPath,
                'proofResidence' => $proofResidencePath,
                'data_err' => '',
            ];

            // Validate form data
            if (empty($data['nic'])) {
                $data['data_err'] = 'Please enter NIC number';
            }
            // validate NIC number
            if (strlen($data['nic']) != 10 && strlen($data['nic']) != 12) {
                $data['data_err'] = 'NIC number invalid length';
            }
            if (strlen($data['nic']) == 10) {
                if (!preg_match('/^[0-9]{9}[vV]$/', $data['nic'])) {
                    $data['data_err'] = 'Invalid NIC number';
                }
            }
            if (strlen($data['nic']) == 12) {
                if (!preg_match('/^[0-9]{12}$/', $data['nic'])) {
                    $data['data_err'] = 'Invalid NIC number';
                }
            }

            // Make sure there are no errors
            if (empty($data['data_err'])) {
                // Validation passed
                //Execute
                if ($this->driverModel->addDriverForm($data)) {
                    if ($this->driverModel->updateFormState($data['driver_id'])) {
                        redirect('drivers/index');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('drivers/driverForm', $data);
            }
        }
    }

    public function driverPending()
    {
        $data = [];
        $this->view('drivers/driverPending', $data);
    }


    public function findVehicles()
    {
        if($this->driverModel->driverRequestPending($_SESSION['user_id'])){
            redirect('drivers/pendingRequest');
        }

        $data = [
            'vehicles' => $this->driverModel->getVacantVehicles()
        ];
        $this->view('drivers/findVehicles', $data);
    }

    public function requestVehicle($vehicle_id)
    {
        $data = [
            'driver_id' => $_SESSION['user_id'],
            'vehicle_id' => $vehicle_id
        ];

        if ($this->driverModel->requestVehicle($data)) {
            redirect('drivers/findVehicles');
        } else {
            die('Something went wrong');
        }
    }

    public function pendingRequest()
    {

        if(!$this->driverModel->driverRequestPending($_SESSION['user_id'])){
            redirect('drivers/findVehicles');
        }

        $data = [
            'vehicle' => $this->driverModel->driverRequestedVehicle($_SESSION['user_id'])
        ];
        $this->view('drivers/pendingRequest', $data);
    }

    public function cancelRequest($vehicle_id)
    {
        $data = [
            'driver_id' => $_SESSION['user_id'],
            'vehicle_id' => $vehicle_id
        ];

        if ($this->driverModel->driverCancelRequest($data)) {
            redirect('drivers/findVehicles');
        } else {
            die('Something went wrong');
        }
    }
}
