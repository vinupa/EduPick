<?php
    class Parent_ {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getChildren($parent_id){
            $this->db->query('SELECT child.*, school.schoolId, school.name as schoolName, vehicle.licensePlate, driver.firstName as driverFirstName, driver.lastName as driverLastName FROM child JOIN school ON child.schoolId = school.schoolID LEFT JOIN vehicle ON child.vehicleId = vehicle.vehicleId LEFT JOIN driver ON vehicle.driverId = driver.driverId WHERE parentID = :parent_id AND child.isDeleted = 0');
            $this->db->bind(':parent_id', $parent_id);

            $results = $this->db->resultSet();

            return $results;
        }

        public function getUnassignedChildren($parent_id){
            $this->db->query('SELECT child.*, school.schoolId, school.name as schoolName FROM child JOIN school ON child.schoolId = school.schoolID WHERE parentID = :parent_id AND isDeleted = 0 AND vehicleId IS NULL');
            $this->db->bind(':parent_id', $parent_id);

            $results = $this->db->resultSet();

            return $results;
        }
     
        public function getAssignedChildren($parent_id){
            $this->db->query('SELECT child.*, school.schoolId, school.name as schoolName FROM child JOIN school ON child.schoolId = school.schoolID WHERE parentID = :parent_id AND isDeleted = 0 AND vehicleId IS NOT NULL');
            $this->db->bind(':parent_id', $parent_id);

            $results = $this->db->resultSet();

            return $results;
        }
     
        public function addChild($data){
            $this->db->query('INSERT INTO child (firstName, lastName, schoolId, grade, parentID, absentState) VALUES (:fname, :lname, :school, :grade, :parentID, 0)');
            $this->db->bind(':fname', $data['fname']);
            $this->db->bind(':lname', $data['lname']);
            $this->db->bind(':school', $data['school']);
            $this->db->bind(':grade', $data['grade']);
            $this->db->bind(':parentID', $data['parentID']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getChild($child_id){
            $this->db->query('SELECT child.*, school.schoolId FROM child JOIN school ON child.schoolId = school.schoolID WHERE childID = :child_id AND isDeleted = 0');
            $this->db->bind(':child_id', $child_id);

            $row = $this->db->single();

            return $row;
        }

        public function updateChild($data){
            $this->db->query('UPDATE child SET firstName = :fname, lastName = :lname, schoolId = :school, grade = :grade WHERE childID = :child_id');
            $this->db->bind(':child_id', $data['child_id']);
            $this->db->bind(':fname', $data['firstName']);
            $this->db->bind(':lname', $data['lastName']);
            $this->db->bind(':school', $data['school']);
            $this->db->bind(':grade', $data['grade']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function removeChild($child_id){
            // $this->db->query('DELETE FROM child WHERE childID = :child_id');
            $this->db->query('UPDATE child SET isDeleted = 1 WHERE childID = :child_id');
            $this->db->bind(':child_id', $child_id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getCity($parent_id){
            $this->db->query('SELECT * FROM city JOIN parent ON city.cityId = parent.cityId WHERE parentID = :parent_id');
            $this->db->bind(':parent_id', $parent_id);

            $row = $this->db->single();

            return $row;
        }

        public function getSchool($school_id){
            $this->db->query('SELECT name FROM school WHERE schoolID = :school_id');
            $this->db->bind(':school_id', $school_id);

            $row = $this->db->single();

            return $row;
        }

        public function getSchools(){
            $this->db->query('SELECT * FROM school');

            $results = $this->db->resultSet();

            return $results;
        }

        public function getVehicles($city_id, $school_id){
            $this->db->query('SELECT vehicle.*, `owner`.firstName, `owner`.lastName, `owner`.contactNumber FROM vehicle JOIN `owner` ON vehicle.ownerID = `owner`.ownerID JOIN vehiclecities ON vehicle.vehicleId = vehiclecities.vehicleId JOIN vehicleschools ON vehicle.vehicleId = vehicleschools.vehicleId WHERE vehiclecities.cityId = :city_id AND vehicleschools.schoolId = :school_id AND vehicle.approvedState = 1 AND vehicle.driverId IS NOT NULL');
            $this->db->bind(':city_id', $city_id);
            $this->db->bind(':school_id', $school_id);

            $results = $this->db->resultSet();

            return $results;
        }

        public function requestVehicle($vehicleId, $childId){
            $this->db->query('INSERT INTO childvehiclerequest (vehicleId, childId) VALUES (:vehicleId, :childId)');
            $this->db->bind(':vehicleId', $vehicleId);
            $this->db->bind(':childId', $childId);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function haspendingRequest($child_id){
            $this->db->query('SELECT * FROM childvehiclerequest WHERE childId = :child_id AND declinedState = 0');
            $this->db->bind(':child_id', $child_id);

            $row = $this->db->single();

            if($row){
                return true;
            } else {
                return false;
            }
        }
        public function pendingRequest($child_id){
            $this->db->query('SELECT vehicle.*, `owner`.firstName, `owner`.lastName, `owner`.contactNumber FROM vehicle JOIN `owner` ON vehicle.ownerID = `owner`.ownerID JOIN childvehiclerequest ON vehicle.vehicleId = childvehiclerequest.vehicleId WHERE childvehiclerequest.childId = :child_id AND childvehiclerequest.declinedState = 0');
            $this->db->bind(':child_id', $child_id);

            $row = $this->db->single();

            return $row;
        }

        public function getDriver($driver_id){
            $this->db->query('SELECT driverID, firstName, lastName, nic, contactNumber, `address`, image_profilePhoto FROM driver WHERE driverId = :driver_id');
            $this->db->bind(':driver_id', $driver_id);

            $row = $this->db->single();

            return $row;
        }

        public function cancelRequest($child_id){
            $this->db->query('DELETE FROM childvehiclerequest WHERE childId = :child_id');
            $this->db->bind(':child_id', $child_id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function childAttending($child_id){
            $this->db->query('UPDATE child SET absentState = 0 WHERE childID = :child_id');
            $this->db->bind(':child_id', $child_id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function childAbsent($child_id){
            $this->db->query('UPDATE child SET absentState = 1 WHERE childID = :child_id');
            $this->db->bind(':child_id', $child_id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function disconnectVehicle($child_id){
            //get the vehicle id from child table
            $this->db->query('SELECT vehicleId FROM child WHERE childID = :child_id');
            $this->db->bind(':child_id', $child_id);
            $row = $this->db->single();

            //increase vacant seat of the vehicle
            $this->db->query('UPDATE vehicle SET vacantSeats = vacantSeats + 1 WHERE vehicleId = :vehicle_id');
            $this->db->bind(':vehicle_id', $row->vehicleId);
            $this->db->execute();

            //update the child table
            $this->db->query('UPDATE child SET vehicleId = NULL WHERE childID = :child_id');
            $this->db->bind(':child_id', $child_id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function vehiclesListComplaint($parent_id){
            $this->db->query('SELECT vehicle.vehicleId, vehicle.licensePlate, child.firstName as childFirstName, child.lastName as childLastName, driver.firstName as driverFirstName, driver.lastName as driverLastName FROM vehicle JOIN `owner` ON vehicle.ownerId = `owner`.ownerID JOIN child ON vehicle.vehicleId = child.vehicleId JOIN driver ON vehicle.driverId = driver.driverId WHERE child.parentID = :parent_id');
            $this->db->bind(':parent_id', $parent_id);

            $results = $this->db->resultSet();

            return $results;
        }

        public function reportIncident($data){
            $this->db->query('INSERT INTO incident (title, `description`, vehicleID, parentID) VALUES (:title, :descr, :vehicleID, :parentID)');
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':descr', $data['description']);
            $this->db->bind(':vehicleID', $data['vehicleID']);
            $this->db->bind(':parentID', $data['parentID']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getIncidentReports($parent_id){
            $this->db->query('SELECT incident.*, vehicle.licensePlate, driver.firstName as driverFirstName, driver.lastName as driverLastName FROM incident JOIN vehicle ON incident.vehicleID = vehicle.vehicleId JOIN driver ON vehicle.driverId = driver.driverId WHERE parentID = :parent_id');
            $this->db->bind(':parent_id', $parent_id);

            $results = $this->db->resultSet();

            return $results;
        }

        public function reportResolved($incident_id){
            $this->db->query('UPDATE incident SET resolvedState = 1 WHERE incidentID = :incident_id');
            $this->db->bind(':incident_id', $incident_id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function reportDelete($incident_id){
            $this->db->query('DELETE FROM incident WHERE incidentID = :incident_id');
            $this->db->bind(':incident_id', $incident_id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
    }