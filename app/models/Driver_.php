<?php
    class Driver_ {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getDriver($driver_id){
            $this->db->query('SELECT * FROM driver WHERE driverID = :driver_id');
            $this->db->bind(':driver_id', $driver_id);

            $row = $this->db->single();

            return $row;
        }

        public function addDriverForm($data){
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

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function updateFormState($driver_id){
            $this->db->query('UPDATE driver SET formState = 1, pendingState = 1 WHERE driverID = :driver_id');
            $this->db->bind(':driver_id', $driver_id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getVacantVehicles(){
            // $this->db->query('SELECT * FROM vehicle WHERE driverID IS NULL'); 
            // $this->db->query('SELECT vehicle.*, owner.firstName, owner.lastName FROM vehicle JOIN owner ON vehicle.ownerId = owner.ownerID WHERE vehicle.driverId IS NULL');
            $this->db->query('SELECT vehicle.*, owner.firstName, owner.lastName, owner.contactNumber FROM vehicle JOIN owner ON vehicle.ownerId = owner.ownerID WHERE vehicle.driverId IS NULL' );
            //  AND vehicle.vehicleId NOT IN (SELECT vehicleId FROM drivervehiclerequest WHERE driverId = :driver_id)');
            // $this->db->bind(':driver_id', $_SESSION['user_id']);
            $rows = $this->db->resultSet();

            return $rows;
        }

        public function requestVehicle($data){
            $this->db->query('INSERT INTO drivervehiclerequest (driverId, vehicleId) VALUES (:driver_id, :vehicle_id)');
            $this->db->bind(':driver_id', $data['driver_id']);
            $this->db->bind(':vehicle_id', $data['vehicle_id']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function driverRequestPending($driver_id){
            $this->db->query('SELECT * FROM drivervehiclerequest WHERE driverId = :driver_id AND declinedState = 0');
            $this->db->bind(':driver_id', $driver_id);

            $row = $this->db->single();

            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }

        public function driverRequestedVehicle($driver_id){
            $this->db->query('SELECT vehicle.*, owner.firstName, owner.lastName, owner.contactNumber FROM vehicle JOIN owner ON vehicle.ownerId = owner.ownerID WHERE vehicle.vehicleId IN (SELECT vehicleId FROM drivervehiclerequest WHERE driverId = :driver_id AND declinedState = 0)');
            $this->db->bind(':driver_id', $driver_id);

            $row = $this->db->single();

            return $row;
        }

        public function driverCancelRequest($data){
            $this->db->query('DELETE FROM drivervehiclerequest WHERE driverId = :driver_id AND vehicleId = :vehicle_id');
            $this->db->bind(':driver_id', $data['driver_id']);
            $this->db->bind(':vehicle_id', $data['vehicle_id']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function isDriverConnected($data){
            $this->db->query('SELECT * FROM driver WHERE driverID = :driver_id AND vehicleID != NULL');
            $this->db->bind(':driver_id', $data['driver_id']);

            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
    }
}