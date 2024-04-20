<?php
    class Owner_ {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }
        

        public function addVehicle($data){
            $this->db->query('INSERT INTO vehicle (licensePlate, vacantSeats, totalSeats, ownerID, cities, schools, features) VALUES (:licensePlate, :vacantSeats, :totalSeats, :ownerID, :cities, :schools, :features)');
            $this->db->bind(':licensePlate', $data['licensePlate']);
            $this->db->bind(':vacantSeats',$data['vacantSeats']);
            $this->db->bind(':totalSeats',$data['totalSeats']);
            $this->db->bind(':ownerID',$data['ownerID']);
            $this->db->bind(':cities',$data['cities']);
            $this->db->bind(':schools',$data['schools']);
            $this->db->bind(':features',$data['features']);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        } 

        
        public function getVehicles($owner_id){
            $this->db->query('SELECT vehicleID, features FROM vehicle WHERE vehicleID = :vehicle_id AND isDeleted = 0');
            $this->db->bind(':vehicle_id', $vehicle_id);
        
            $results = $this->db->resultSet();
        
            return $results;
        }


        public function removeVehicle($vehicle_id){
            // $this->db->query('DELETE FROM vehicle WHERE vehicleID = :vehicle_id');
            $this->db->query('UPDATE vehicle SET isDeleted = 1 WHERE vehicleID = :vehicle_id');
            $this->db->bind(':vehicle_id', $vehicle_id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }


        public function updateVehicle($data){
            $this->db->query('UPDATE vehicle SET vacantSeats = :vacantSeats, totalSeats = :totalSeats, cities = :cities, schools = :schools, features = :features WHERE vehicleID = :vehicle_id');
            $this->db->bind(':vacantSeats',$data['vacantSeats']);
            $this->db->bind(':totalSeats',$data['totalSeats']);
            $this->db->bind(':cities',$data['cities']);
            $this->db->bind(':schools',$data['schools']);
            $this->db->bind(':features',$data['features']);


            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }


        public function getDriver($driver_id){
            $this->db->query('SELECT firstName, vehicleID, contactNumber, image_profilePhoto FROM driver WHERE driverID = :driver_id AND isDeleted = 0');
            $this->db->bind(':driver_id', $driver_id);
        
            $results = $this->db->resultSet();
        
            // Iterate through each result and retrieve image data
            foreach ($results as &$result) {
            // Assuming $result['image_profilePhoto'] contains binary image data, retrieve it
            $imageData = $result['image_profilePhoto'];
            // Store the image data in the result array
            $result['image_profilePhoto'] = $imageData;
            }
        
            return $results;
        }
        
        
        public function getCustomer($parent_id){
            $this->db->query('SELECT parentID, firstName, lastName, city, contactNumber FROM parent WHERE parentID = :parent_id AND isDeleted = 0');
            $this->db->bind(':parent_id', $parent_id);
        
            $results = $this->db->resultSet();
        
            return $results;
        }

      

        public function removeCustomer($parent_id){
            // $this->db->query('DELETE FROM parent WHERE parentID = :parent_id');
            $this->db->query('UPDATE parent SET isDeleted = 1 WHERE parentID = :parent_id');
            $this->db->bind(':parent_id', $parent_id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getEligibleDrivers($vehicleID) {
            // Query to retrieve drivers where vehicleID is null for the given vehicleID
            $query = "SELECT driverID FROM driver WHERE vehicleID IS NULL";
            // Execute the query and fetch results
            // Note: You need to execute the query using your database connection method
            $result = $this->db->query($query);
            $eligibleDrivers = $result->fetchAll(PDO::FETCH_ASSOC);
            return $eligibleDrivers;
        }
        


    }