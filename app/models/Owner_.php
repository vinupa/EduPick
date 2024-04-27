<?php
    class Owner_ {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getCities(){
            $this->db->query('SELECT * FROM city');
            $results = $this->db->resultSet();
            return $results;
        }


        public function getSchools(){
            $this->db->query('SELECT * FROM school');
            $results = $this->db->resultSet();
            return $results;
        }

        
        public function getAllVehicles($owner_id){
            // $this->db->query('SELECT * FROM vehicle WHERE ownerId = :owner_id');
            $this->db->query('SELECT vehicle.*, driver.firstName, driver.lastName FROM vehicle LEFT JOIN driver ON vehicle.vehicleId = driver.vehicleId WHERE vehicle.ownerId = :owner_id');
            $this->db->bind(':owner_id', $owner_id);
            $results = $this->db->resultSet();
            return $results;
        }


        public function getLastVehicleId(){
            $this->db->query('SELECT MAX(vehicleId) as vehicleId FROM vehicle');
            $result = $this->db->single();
            return $result;
        }


        public function addVehicle($data){
            $this->db->query('INSERT INTO vehicle (licensePlate, model, modelYear, ac, highroof, totalSeats, vacantSeats, ownerId, image_vehicle, doc_registration, doc_emissions) VALUES (:licensePlate, :model, :modelYear, :ac, :highroof, :totalSeats, :vacantSeats, :owner_id, :vehicleImage, :registrationDoc, :emissionsReport)');
            
            $this->db->bind(':owner_id', $data['owner_id']);
            $this->db->bind(':licensePlate', $data['licensePlate']);
            $this->db->bind(':model', $data['model']);
            $this->db->bind(':modelYear', $data['modelYear']);
            $this->db->bind(':ac', $data['ac']);
            $this->db->bind(':highroof', $data['highroof']);
            $this->db->bind(':totalSeats', $data['totalSeats']);
            $this->db->bind(':vacantSeats', $data['vacantSeats']);
            $this->db->bind(':vehicleImage', $data['vehicleImage']);
            $this->db->bind(':registrationDoc', $data['registrationDoc']);
            $this->db->bind(':emissionsReport', $data['emissionsReport']);

            // add a query into the vehicle cities table for each city selected
            if($this->db->execute()){
                $vehicle_id = $this->getLastVehicleId()->vehicleId;
                $this->db->query('INSERT INTO vehiclecities (vehicleId, cityId) VALUES (:vehicle_id, :city_id)');
                foreach($data['city'] as $city){
                    $this->db->bind(':vehicle_id', $vehicle_id);
                    $this->db->bind(':city_id', $city);
                    $this->db->execute();
                }

                // add a query into the vehicle schools table for each school selected
                $this->db->query('INSERT INTO vehicleschools (vehicleId, schoolId) VALUES (:vehicle_id, :school_id)');
                foreach($data['school'] as $school){
                    $this->db->bind(':vehicle_id', $vehicle_id);
                    $this->db->bind(':school_id', $school);
                    $this->db->execute();
                }

                return true;
            } else {
                return false;
            }
        }

        
        public function getDriverRequests($owner_id){
            $this->db->query('SELECT drivervehiclerequest.*, driver.firstName, driver.lastName, driver.image_profilePhoto, driver.nic, driver.contactNumber, vehicle.model FROM drivervehiclerequest JOIN driver ON drivervehiclerequest.driverId = driver.driverId JOIN vehicle ON drivervehiclerequest.vehicleId = vehicle.vehicleId WHERE vehicle.ownerId = :owner_id AND drivervehiclerequest.declinedState = 0');
            $this->db->bind(':owner_id', $owner_id);
            $results = $this->db->resultSet();
            return $results;
        }


        public function acceptRequest($request_id){

            //get vehicle id and driver id from the request
            $this->db->query('SELECT * FROM drivervehiclerequest WHERE requestId = :request_id');
            $this->db->bind(':request_id', $request_id);
            $result = $this->db->single();

            //get owner id using the vehicle id from vehicle table
            $this->db->query('SELECT ownerId FROM vehicle WHERE vehicleId = :vehicle_id');
            $this->db->bind(':vehicle_id', $result->vehicleId);
            $owner_data = $this->db->single();

            //update the driver table with vehicle id and owner id
            $this->db->query('UPDATE driver SET vehicleID = :vehicle_id, ownerID = :owner_id WHERE driverId = :driver_id');
            $this->db->bind(':vehicle_id', $result->vehicleId);
            $this->db->bind(':owner_id', $owner_data->ownerId);
            $this->db->bind(':driver_id', $result->driverId);
            $this->db->execute();

            //update the vehicle table with driver id
            $this->db->query('UPDATE vehicle SET driverId = :driver_id WHERE vehicleId = :vehicle_id');
            $this->db->bind(':driver_id', $result->driverId);
            $this->db->bind(':vehicle_id', $result->vehicleId);
            $this->db->execute();

            //delete the request from the drivervehiclerequest table
            $this->db->query('DELETE FROM drivervehiclerequest WHERE requestId = :request_id');
            $this->db->bind(':request_id', $request_id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
        

        public function declineRequest($request_id){
            $this->db->query('UPDATE drivervehiclerequest SET declinedState = 1 WHERE requestId = :request_id');
            $this->db->bind(':request_id', $request_id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }




        public function updateVehicle($data){
            $this->db->query('UPDATE vehicle SET licensePlate = :licensePlate, model = :model, modelYear = :modelYear, vacantSeats = :vacantSeats, totalSeats = :totalSeats, ac = :ac, highroof = :highroof WHERE vehicleId = :vehicle_id');
            $this->db->bind(':vehicle_id', $data['vehicle_id']);
            $this->db->bind(':licensePlate', $data['licensePlate']);
            $this->db->bind(':model', $data['model']);
            $this->db->bind(':modelYear', $data['modelYear']);
            $this->db->bind(':vacantSeats', $data['vacantSeats']);
            $this->db->bind(':totalSeats', $data['totalSeats']);
            $this->db->bind(':ac', $data['ac']);
            $this->db->bind(':highroof', $data['highroof']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        

       

        public function getvehicleById($id)
        {
            $this->db->query('SELECT vehicle.* FROM vehicle  WHERE vehicle.vehicleId = :id');
            $this->db->bind(':id', $id);
            $results = $this->db->single();
            return $results;
        }
        
        public function getcityById($id)
        {           
            $this->db->query('SELECT vehiclecities.* FROM vehiclecities  WHERE vehiclecities.vehicleId = :id');
            $this->db->bind(':id', $id);
            $results = $this->db->single();
            return $results;
        }
        public function getcitynameById($id)
        {           
            $this->db->query('SELECT city.* FROM city  WHERE city.cityId = :id');
            $this->db->bind(':id', $id);
            $results = $this->db->single();
            return $results;
        }




        public function getvehiclesById($id)
        {
            $this->db->query('SELECT vehicle.* FROM vehicle  WHERE vehicle.vehicleId = :id');
            $this->db->bind(':id', $id);
            $results = $this->db->single();
            return $results;
        }
        
        public function getschoolById($id)
        {           
            $this->db->query('SELECT vehicleschools.* FROM vehicleschools  WHERE vehicleschools.vehicleId = :id');
            $this->db->bind(':id', $id);
            $results = $this->db->single();
            return $results;
        }
        public function getschoolnameById($id)
        {           
            $this->db->query('SELECT school.* FROM school  WHERE school.schoolId = :id');
            $this->db->bind(':id', $id);
            $results = $this->db->single();
            return $results;
        }


        /*public function getAllCustomers($parent_id) {
            $this->db->query('SELECT parent.*, child.firstName, child.school FROM parent LEFT JOIN child ON parent.parentID = child.parentID WHERE parent.parentID = :parent_id');
            $this->db->bind(':parent_id', $parent_id);
            $results = $this->db->resultSet();
            return $results;
        }

        
        public function getAllParents($parent_id){
            $this->db->query('SELECT child.*, parent.parentID, parent.firstName, parent.contactNumber FROM child LEFT JOIN parent ON child.parentID = parent.parentID WHERE child.parentID = :parent_id');
            $this->db->bind(':parent_id', $parent_id);
            $results = $this->db->resultSet();
            return $results;
        }*/
        
    
        public function getAllDrivers($owner_id) {
            $this->db->query('SELECT driver.firstName, vehicle.licensePlate, vehicle.model, driver.contactNumber 
                             FROM driver 
                             JOIN vehicle 
                             ON driver.vehicleID = vehicle.vehicleId 
                             WHERE vehicle.ownerId = :owner_id');
            $this->db->bind(':owner_id', $owner_id);
            $results = $this->db->resultSet();
            return $results;
        }
        
    
       /* // Get parents with their children who use the owner's vehicle or van
        public function getAllParents($owner_id) {
            $this->db->query('SELECT owner.*, vehicle.*
                                FROM owner
                                JOIN vehicle
                                ON owner.ownerID = vehicle.ownerId
                                WHERE owner.ownerID = :owner_id');
            $this->db->bind(':owner_id', $owner_id);
            $results = $this->db->resultSet();
            return $results;
        }

        public function getChild($vehicle_id)
        {
            $this->db->query('SELECT child.*, parent.*
                                FROM child
                                JOIN parent
                                ON child.parentID = parent.parentID
                                WHERE child.vehicleId = :vehicle_id');
            $this->db->bind(':vehicle_id', $vehicle_id);
            $results = $this->db->resultSet();
            return $results;

        }*/

        public function getAllParents($owner_id) {
            $this->db->query ('SELECT parent.firstName, child.firstName AS childFirstName, child.school, parent.contactNumber 
                                FROM owner
                                JOIN vehicle 
                                ON owner.ownerID = vehicle.ownerId
                                JOIN child 
                                ON vehicle.vehicleId = child.vehicleId
                                JOIN parent 
                                ON child.parentID = parent.parentID
                                WHERE owner.ownerID = :owner_id');
             $this->db->bind(':owner_id', $owner_id);
             $results = $this->db->resultSet();
             return $results;
         }

         public function getChild($owner_id){
            $this->db->query('SELECT child.firstName FROM child');
            $results = $this->db->resultSet();
            return $results;
        }
        



        public function getChildRequests($owner_id){
            $this->db->query('SELECT parent.firstName, parent.lastName, parent.contactNumber, child.firstName AS childFirstName, child.lastName AS childLastName, driver.firstName AS driverFirstName, child.school, vehicle.licensePlate
            FROM child 
            JOIN parent 
            ON child.parentID = parent.parentID 
            JOIN driver
            ON child.vehicleId = driver.vehicleID
            JOIN vehicle 
            ON child.vehicleId = vehicle.vehicleId 
            WHERE vehicle.ownerId = :owner_id AND child.vehicleId IS NULL');
            $this->db->bind(':owner_id', $owner_id);
            $results = $this->db->resultSet();
            return $results;

        }

        public function acceptChildRequest($parent_id){
            // Fetch child data including vehicleId
            $this->db->query('SELECT * FROM child WHERE parentID = :parent_id');
            $this->db->bind(':parent_id', $parent_id);
            $childData = $this->db->single();
        
            // Fetch vehicle data
            $this->db->query('SELECT * FROM vehicle WHERE vehicleId = :vehicle_id');
            $this->db->bind(':vehicle_id', $childData->vehicleId);
            $vehicleData = $this->db->single();
        
            // Update child table with vehicleId and ownerId
            $this->db->query('UPDATE child SET vehicleId = :vehicle_id, ownerId = :owner_id WHERE parentID = :parent_id');
            $this->db->bind(':vehicle_id', $childData->vehicleId);
            $this->db->bind(':owner_id', $vehicleData->ownerId);
            $this->db->bind(':parent_id', $parent_id);
            $this->db->execute();
        
            // Calculate the updated number of vacant seats
            $vacantSeats = $vehicleData->totalSeats - 1; // Assuming one seat is occupied
        
            // Update the vehicle table with the new number of vacant seats
            $this->db->query('UPDATE vehicle SET vacantSeats = :vacant_seats WHERE vehicleId = :vehicle_id');
            $this->db->bind(':vacant_seats', $vacantSeats);
            $this->db->bind(':vehicle_id', $childData->vehicleId);
            $this->db->execute();
        
            // Delete the request from the child table
            $this->db->query('DELETE FROM child WHERE parentID = :parent_id');
            $this->db->bind(':parent_id', $parent_id);
        
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        public function declineChildRequest($parent_id){
            // Update child table to set vehicleId to NULL
            $this->db->query('UPDATE child SET vehicleId = NULL WHERE parentID = :parent_id');
            $this->db->bind(':parent_id', $parent_id);
        
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        

    }

       