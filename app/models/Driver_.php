<?php
class Driver_
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getDriver($driver_id)
    {
        $this->db->query('SELECT * FROM driver WHERE driverID = :driver_id');
        $this->db->bind(':driver_id', $driver_id);

        $row = $this->db->single();

        return $row;
    }

    public function addDriverForm($data)
    {
        $this->db->query('UPDATE driver SET nic = :nic, image_profilePhoto = :profilePhoto, image_nicFront = :nicFront, image_nicBack = :nicBack, image_licenseFront = :licenseFront, image_licenseBack = :licenseBack, doc_policeReport = :policeReport, doc_proofResidence = :proofResidence WHERE driverID = :driverID');

        $this->db->bind(':driverID', $data['driver_id']);
        $this->db->bind(':nic', $data['nic']);
        $this->db->bind(':profilePhoto', $data['profilePhoto']);
        $this->db->bind(':nicFront', $data['nicFront']);
        $this->db->bind(':nicBack', $data['nicBack']);
        $this->db->bind(':licenseFront', $data['licenseFront']);
        $this->db->bind(':licenseBack', $data['licenseBack']);
        $this->db->bind(':policeReport', $data['policeReport']);
        $this->db->bind(':proofResidence', $data['proofResidence']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateFormState($driver_id)
    {
        $this->db->query('UPDATE driver SET formState = 1, pendingState = 1 WHERE driverID = :driver_id');
        $this->db->bind(':driver_id', $driver_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getVacantVehicles()
    {
        $this->db->query('SELECT vehicle.*, owner.firstName, owner.lastName, owner.contactNumber FROM vehicle JOIN owner ON vehicle.ownerId = owner.ownerID WHERE vehicle.driverId IS NULL');
        $rows = $this->db->resultSet();

        return $rows;
    }

    public function requestVehicle($data)
    {
        $this->db->query('INSERT INTO drivervehiclerequest (driverId, vehicleId) VALUES (:driver_id, :vehicle_id)');
        $this->db->bind(':driver_id', $data['driver_id']);
        $this->db->bind(':vehicle_id', $data['vehicle_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function driverRequestPending($driver_id)
    {
        $this->db->query('SELECT * FROM drivervehiclerequest WHERE driverId = :driver_id AND declinedState = 0');
        $this->db->bind(':driver_id', $driver_id);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function driverRequestedVehicle($driver_id)
    {
        $this->db->query('SELECT vehicle.*, owner.firstName, owner.lastName, owner.contactNumber FROM vehicle JOIN owner ON vehicle.ownerId = owner.ownerID WHERE vehicle.vehicleId IN (SELECT vehicleId FROM drivervehiclerequest WHERE driverId = :driver_id AND declinedState = 0)');
        $this->db->bind(':driver_id', $driver_id);

        $row = $this->db->single();

        return $row;
    }

    public function driverCancelRequest($data)
    {
        $this->db->query('DELETE FROM drivervehiclerequest WHERE driverId = :driver_id AND vehicleId = :vehicle_id');
        $this->db->bind(':driver_id', $data['driver_id']);
        $this->db->bind(':vehicle_id', $data['vehicle_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function isDriverConnected($driver_id)
    {
        $this->db->query('SELECT vehicleID FROM driver WHERE driverID = :driver_id');
        $this->db->bind(':driver_id', $driver_id);

        $row = $this->db->single();

        if ($row->vehicleID) {
            return true;
        } else {
            return false;
        }
    }

    public function getChildren($driver_id)
    {
        $this->db->query('SELECT child.*, school.name as schoolName FROM child JOIN school ON child.schoolId = school.schoolId WHERE child.vehicleId = (SELECT vehicleID FROM driver WHERE driverID = :driver_id) AND child.isDeleted = 0 ORDER BY child.absentState DESC');
        $this->db->bind(':driver_id', $driver_id);

        $rows = $this->db->resultSet();

        return $rows;
    }

    public function getVehicle($driver_id){
        $this->db->query('SELECT vehicle.*, owner.firstName, owner.lastName, owner.contactNumber FROM vehicle JOIN owner ON vehicle.ownerId = owner.ownerID WHERE vehicle.vehicleId = (SELECT vehicleID FROM driver WHERE driverID = :driver_id)');
        $this->db->bind(':driver_id', $driver_id);

        $row = $this->db->single();

        return $row;
    }

    public function resignVehicle($driver_id){
        
        $this->db->query('UPDATE vehicle SET driverId = NULL WHERE vehicleId = (SELECT vehicleID FROM driver WHERE driverID = :driver_id)');
        $this->db->bind(':driver_id', $driver_id);

        if ($this->db->execute()) {

            $this->db->query('UPDATE driver SET vehicleID = NULL, ownerID = NULL WHERE driverID = :driver_id');
            $this->db->bind(':driver_id', $driver_id);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }
}