<?php
#[\AllowDynamicProperties]

class Admins extends Controller
{

    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('users/login');
        } elseif ($_SESSION['user_type'] != 'admin') {
            redirect('users/login');
        }

        $this->adminModel = $this->model('Admin_');
    }

    public function index()
    {
        $data = [];
        $this->view('admins/index', $data);
    }

    public function manageAdmins()
    {
        $data = [
            'admins' => $this->adminModel->getAdmins()
        ];
        $this->view('admins/manageAdmins', $data);
    }

    public function adminDashboard()
    {
        $parentCount = $this->adminModel->getParentCount();
        $ownerCount = $this->adminModel->getOwnerCount();
        $driverCount = $this->adminModel->getDriverCount();
        $registrationData = $this->adminModel->getRegistrationData();


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fromDate = $_POST['from_date'];
            $toDate = $_POST['to_date'];

            $parentRegistrationData = $this->adminModel->getParentRegistrationData($fromDate, $toDate);
            $driverRegistrationData = $this->adminModel->getDriverRegistrationData($fromDate, $toDate);
            $ownerRegistrationData = $this->adminModel->getOwnerRegistrationData($fromDate, $toDate);

            $data = [
                'parentCount' => $parentCount,
                'ownerCount' => $ownerCount,
                'driverCount' => $driverCount,
                'registrationData' => $registrationData,
                'parentRegistrationData' => $parentRegistrationData,
                'driverRegistrationData' => $driverRegistrationData,
                'ownerRegistrationData' => $ownerRegistrationData,
                'fromDate' => $fromDate,
                'toDate' => $toDate
            ];

            $this->view('admins/adminDashboard', $data);
        } else {

            $data = [
                'parentCount' => $parentCount,
                'ownerCount' => $ownerCount,
                'driverCount' => $driverCount,
                'registrationData' => $registrationData
            ];

            $this->view('admins/adminDashboard', $data);
        }
    }

    public function updateAdmin($adminID)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

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

            if (empty($data['firstName_err']) && empty($data['lastName_err']) && empty($data['email_err']) && empty($data['contactNumber_err'])) {

                if ($this->adminModel->updateAdmin($data)) {
                    flash('success', 'Admin updated');
                    redirect('admins/index');
                } else {
                    flash('error', 'Failed to update admin', 'alert alert-danger');
                    redirect('admins/index');
                }
            } else {
                $this->view('admins/updateAdmin', $data);
            }
        } else {
            $admin = $this->adminModel->getAdminById($adminID);

            if ($admin) {

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
                $this->view('admins/updateAdmin', $data);
            } else {
                flash('error', 'Admin not found', 'alert alert-danger');
                redirect('admins/index');
            }
        }
    }

    public function removeAdmin($adminID)
    {

        if ($_SESSION['user_type'] == 'admin' && $_SESSION['user_id'] == 1) {

            if ($adminID != 1) {

                if ($this->adminModel->deleteAdmin($adminID)) {
                    flash('success', 'Admin removed');
                    redirect('admins/manageAdmins');
                } else {
                    flash('error', 'Failed to remove admin', 'alert alert-danger');
                    redirect('admins/manageAdmins');
                }
            } else {
                flash('error', 'Super admin cannot be removed', 'alert alert-danger');
                redirect('admins/manageAdmins');
            }
        } else {
            flash('error', 'Permission denied', 'alert alert-danger');
            redirect('admins/manageAdmins');
        }
    }

    public function vehicleApproval()
    {

        $vehicleRequests = $this->adminModel->getVehicleRequests();

        $data = [
            'vehicleRequests' => $vehicleRequests
        ];

        $this->view('admins/vehicleApproval', $data);
    }

    public function vehicleApprovalDetails($vehicleID)
    {

        $vehicleDetails = $this->adminModel->getVehicleDetails($vehicleID);

        $data = [
            'vehicleDetails' => $vehicleDetails
        ];

        $this->view('admins/vehicleApprovalDetails', $data);
    }

    public function driverApproval()
    {

        $driverRequests = $this->adminModel->getDriverRequests();

        $data = [
            'driverRequests' => $driverRequests
        ];

        $this->view('admins/driverApproval', $data);
    }

    public function driverApprovalDetails($driverID)
    {

        $driverDetails = $this->adminModel->getDriverDetails($driverID);

        $data = [
            'driverDetails' => $driverDetails
        ];

        $this->view('admins/driverApprovalDetails', $data);
    }

    public function approveVehicle($vehicleID)
    {

        if ($this->adminModel->approveVehicle($vehicleID)) {
            flash('success', 'Vehicle approved');
            redirect('admins/vehicleApproval');
        } else {
            flash('error', 'Failed to approve vehicle', 'alert alert-danger');
            redirect('admins/vehicleApproval');
        }
    }

    public function rejectVehicle($vehicleID)
    {

        if ($this->adminModel->rejectVehicle($vehicleID)) {
            flash('success', 'Vehicle rejected');
            redirect('admins/vehicleApproval');
        } else {
            flash('error', 'Failed to reject vehicle', 'alert alert-danger');
            redirect('admins/vehicleApproval');
        }
    }

    public function approveDriver($driverID)
    {

        if ($this->adminModel->approveDriver($driverID)) {
            flash('success', 'Driver approved');
            redirect('admins/driverApproval');
        } else {
            flash('error', 'Failed to approve driver', 'alert alert-danger');
            redirect('admins/driverApproval');
        }
    }

    public function rejectDriver($driverID)
    {

        if ($this->adminModel->rejectDriver($driverID)) {
            flash('success', 'Driver rejected');
            redirect('admins/driverApproval');
        } else {
            flash('error', 'Failed to reject driver', 'alert alert-danger');
            redirect('admins/driverApproval');
        }
    }

    public function exportPDF()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fromDate = $_POST['from_date'];
            $toDate = $_POST['to_date'];

            $parentRegistrationData = $this->adminModel->getParentRegistrationData($fromDate, $toDate);
            $driverRegistrationData = $this->adminModel->getDriverRegistrationData($fromDate, $toDate);
            $ownerRegistrationData = $this->adminModel->getOwnerRegistrationData($fromDate, $toDate);

            $data = [
                'parentRegistrationData' => $parentRegistrationData,
                'driverRegistrationData' => $driverRegistrationData,
                'ownerRegistrationData' => $ownerRegistrationData
            ];
            $this->generatePDF($fromDate, $toDate);
        }
    }

    public function generatePDF($fromDate, $toDate)
    {
        ob_end_clean();

        $parentRegistrationData = $this->adminModel->getParentRegistrationData($fromDate, $toDate);
        $driverRegistrationData = $this->adminModel->getDriverRegistrationData($fromDate, $toDate);
        $ownerRegistrationData = $this->adminModel->getOwnerRegistrationData($fromDate, $toDate);

        require_once APPROOT . '\libraries\tcpdf\tcpdf.php';

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Application Name');
        $pdf->SetTitle('Registration Data Report');
        $pdf->SetSubject('Registration Data Report');

        $pdf->AddPage();

        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->Cell(0, 10, 'Registration Data Report', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Date Range: ' . $fromDate . ' - ' . $toDate, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Parent Registration Data', 0, 1);
        $pdf->Ln(5);

        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->Cell(30, 10, 'Email', 1, 0, 'C');
        $pdf->Cell(30, 10, 'First Name', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Last Name', 1, 0, 'C');
        $pdf->Cell(30, 10, 'City', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Contact Number', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Registration Date', 1, 1, 'C');

        $pdf->SetFont('helvetica', '', 9);
        foreach ($parentRegistrationData as $parent) {
            $pdf->Cell(30, 10, $parent->email, 1, 0, 'C');
            $pdf->Cell(30, 10, $parent->firstName, 1, 0, 'C');
            $pdf->Cell(30, 10, $parent->lastName, 1, 0, 'C');
            $pdf->Cell(30, 10, $parent->city, 1, 0, 'C');
            $pdf->Cell(30, 10, $parent->contactNumber, 1, 0, 'C');
            $pdf->Cell(30, 10, date('Y-m-d', strtotime($parent->regDate)), 1, 1, 'C');
        }

        $pdf->Ln(10);

        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Driver Registration Data', 0, 1);
        $pdf->Ln(5);

        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->Cell(30, 10, 'First Name', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Last Name', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Email', 1, 0, 'C');
        $pdf->Cell(30, 10, 'NIC', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Contact Number', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Registration Date', 1, 1, 'C');

        $pdf->SetFont('helvetica', '', 9);
        foreach ($driverRegistrationData as $driver) {
            $pdf->Cell(30, 10, $driver->firstName, 1, 0, 'C');
            $pdf->Cell(30, 10, $driver->lastName, 1, 0, 'C');
            $pdf->Cell(40, 10, $driver->email, 1, 0, 'C');
            $pdf->Cell(30, 10, $driver->nic, 1, 0, 'C');
            $pdf->Cell(30, 10, $driver->contactNumber, 1, 0, 'C');
            $pdf->Cell(30, 10, date('Y-m-d', strtotime($driver->regDate)), 1, 1, 'C');
        }

        $pdf->Ln(10);

        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Owner Registration Data', 0, 1);
        $pdf->Ln(5);

        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->Cell(40, 10, 'Email', 1, 0, 'C');
        $pdf->Cell(30, 10, 'First Name', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Last Name', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Contact Number', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Registration Date', 1, 1, 'C');

        $pdf->SetFont('helvetica', '', 9);
        foreach ($ownerRegistrationData as $owner) {
            $pdf->Cell(40, 10, $owner->email, 1, 0, 'C');
            $pdf->Cell(30, 10, $owner->firstName, 1, 0, 'C');
            $pdf->Cell(30, 10, $owner->lastName, 1, 0, 'C');
            $pdf->Cell(30, 10, $owner->contactNumber, 1, 0, 'C');
            $pdf->Cell(30, 10, date('Y-m-d', strtotime($owner->regDate)), 1, 1, 'C');
        }

        $pdf->Output('registration_data_report.pdf', 'D');
    }

    public function incidentReports()
    {

        $data = [
            'reports' => $this->adminModel->getIncidentReports()
        ];

        $this->view('admins/incidentReports', $data);
    }

    public function incidentResolved($incidentID)
    {

        if ($this->adminModel->reportResolved($incidentID)) {
            redirect('admins/incidentReports');
        } else {
            die('Something went wrong');
        }
    }

    public function incidentDelete($incidentID)
    {

        if ($this->adminModel->reportDelete($incidentID)) {
            redirect('admins/incidentReports');
        } else {
            die('Something went wrong');
        }
    }
}