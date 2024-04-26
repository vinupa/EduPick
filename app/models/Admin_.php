<?php
class Admin_ {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getAdmins(){
        // Execute the SQL query to select all admins except adminID = 1
        $this->db->query('SELECT * FROM admin WHERE adminID != 1 AND IsDeleted = 0');
        
        // Retrieve the result set
        $results = $this->db->resultSet();
        
        // Return the results
        return $results;
    }

    public function updateAdmin($data){
        // Prepare SQL query to update admin details
        $this->db->query('UPDATE admin SET email = :email, firstName = :firstName, lastName = :lastName, contactNumber = :contactNumber WHERE adminID = :adminID');
    
        // Bind values
        $this->db->bind(':adminID', $data['adminID']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':firstName', $data['firstName']);
        $this->db->bind(':lastName', $data['lastName']);
        $this->db->bind(':contactNumber', $data['contactNumber']);
    
        // Execute the update query
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteAdmin($adminID){
        $this->db->query('UPDATE admin SET IsDeleted = 1 WHERE adminID = :adminID');
        $this->db->bind(':adminID', $adminID);
    
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getAdminById($adminID){
        // Prepare SQL query to select admin by ID
        $this->db->query('SELECT * FROM admin WHERE adminID = :adminID');
    
        // Bind adminID parameter
        $this->db->bind(':adminID', $adminID);
    
        // Fetch single row
        $row = $this->db->single();
    
        // Check if row exists
        if($this->db->rowCount() > 0){
            return $row;
        } else {
            return null;
        }
    }

    public function getVehicleRequests(){
        $this->db->query('SELECT vehicle.*, owner.firstName AS ownerFirstName, owner.lastName AS ownerLastName, owner.contactNumber AS ownerContactNumber FROM vehicle INNER JOIN owner ON vehicle.ownerID = owner.ownerID WHERE vehicle.approvedState = 0');

        // Fetch all records
        return $this->db->resultSet();
    }

    // Get details of a specific vehicle by its ID
    public function getVehicleDetails($vehicleID){
        $this->db->query('SELECT vehicle.*, owner.firstName AS ownerFirstName, owner.lastName AS ownerLastName, owner.contactNumber AS ownerContactNumber FROM vehicle INNER JOIN owner ON vehicle.ownerID = owner.ownerID WHERE vehicle.vehicleID = :vehicle_id');
        $this->db->bind(':vehicle_id', $vehicleID);

        // Fetch single record
        return $this->db->single();
    }

    public function getDriverRequests(){
        $this->db->query('SELECT driver.*, owner.firstName AS ownerFirstName, owner.lastName AS ownerLastName, owner.contactNumber AS ownerContactNumber FROM driver INNER JOIN owner ON driver.ownerID = owner.ownerID WHERE driver.approvedState = 0');

        // Fetch all records
        return $this->db->resultSet();
    }

    // Method to fetch details of a specific driver by their ID
    public function getDriverDetails($driverID){
        $this->db->query('SELECT driver.*, owner.firstName AS ownerFirstName, owner.lastName AS ownerLastName, owner.contactNumber AS ownerContactNumber FROM driver INNER JOIN owner ON driver.ownerID = owner.ownerID WHERE driver.driverID = :driver_id');
        $this->db->bind(':driver_id', $driverID);

        // Fetch single record
        return $this->db->single();
    }

    public function approveVehicle($vehicleID){
        // Prepare query
        $this->db->query('UPDATE vehicle SET approvedState = 1 WHERE vehicleID = :vehicle_id');
        // Bind values
        $this->db->bind(':vehicle_id', $vehicleID);
    
        // Execute query
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function rejectVehicle($vehicleID){
        // Prepare query to update the approvedState to 2 (rejected) for the given vehicleID
        $this->db->query('UPDATE vehicle SET approvedState = 2 WHERE vehicleID = :vehicle_id');
        // Bind parameter
        $this->db->bind(':vehicle_id', $vehicleID);
    
        // Execute the query
        if($this->db->execute()){
            return true; // Return true if the query was successful
        } else {
            return false; // Return false if something went wrong
        }
    }

    public function approveDriver($driverID){
        // Prepare query
        $this->db->query('UPDATE driver SET approvedState = 1 WHERE driverID = :driver_id');
        // Bind values
        $this->db->bind(':driver_id', $driverID);
    
        // Execute query
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function rejectDriver($driverID){
        // Prepare query to update the approvedState to 2 (rejected) for the given driverID
        $this->db->query('UPDATE vehicle SET approvedState = 2 WHERE driverID = :driver_id');
        // Bind parameter
        $this->db->bind(':driver_id', $driverID);
    
        // Execute the query
        if($this->db->execute()){
            return true; // Return true if the query was successful
        } else {
            return false; // Return false if something went wrong
        }
    }

    public function getParentCount(){
        // Prepare SQL query to count parents
        $this->db->query('SELECT COUNT(*) AS parentCount FROM parent');
    
        // Execute the query and fetch the result
        $result = $this->db->single();
    
        // Return the count of parents
        return $result->parentCount;
    }
    
    public function getOwnerCount(){
        // Prepare SQL query to count owners
        $this->db->query('SELECT COUNT(*) AS ownerCount FROM owner');
    
        // Execute the query and fetch the result
        $result = $this->db->single();
    
        // Return the count of owners
        return $result->ownerCount;
    }
    
    public function getDriverCount(){
        // Prepare SQL query to count drivers
        $this->db->query('SELECT COUNT(*) AS driverCount FROM driver');
    
        // Execute the query and fetch the result
        $result = $this->db->single();
    
        // Return the count of drivers
        return $result->driverCount;
    }

    public function getRegistrationData() {
        // Get the registration data for the past 30 days
        $currentDate = new DateTime();
        $currentDate->sub(new DateInterval('P30D'));
        $startDate = $currentDate->format('Y-m-d');
      
        // Query the database to get the total number of registered users for each day in the past 30 days
        $this->db->query('
          SELECT 
            DATE(regDate) AS date, 
            SUM(CASE WHEN type = "parent" THEN 1 ELSE 0 END) AS parents,
            SUM(CASE WHEN type = "owner" THEN 1 ELSE 0 END) AS owners,
            SUM(CASE WHEN type = "driver" THEN 1 ELSE 0 END) AS drivers
          FROM (
            SELECT regDate, "parent" AS type FROM parent
            UNION ALL
            SELECT regDate, "owner" AS type FROM owner
            UNION ALL
            SELECT regDate, "driver" AS type FROM driver
          ) AS combined
          WHERE regDate >= :startDate
          GROUP BY date
          ORDER BY date DESC
        ');
      
        // Bind the start date parameter
        $this->db->bind(':startDate', $startDate);
      
        // Execute the query and get the result set
        $results = $this->db->resultSet();
      
        // Format the data for Chart.js
        $formattedData = [];
        foreach ($results as $row) {
          $formattedData[] = [
            'date' => strtotime($row->date), // Convert the date string to a Unix timestamp
            'parents' => $row->parents,
            'owners' => $row->owners,
            'drivers' => $row->drivers,
          ];
        }
      
        // Return the formatted data
        return $formattedData;
      }
}
?>  