<?php
class Admin_ {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getAdmins(){

        $this->db->query('SELECT * FROM admin WHERE adminID != 1 AND IsDeleted = 0');
        
        $results = $this->db->resultSet();
        
        return $results;
    }

    public function updateAdmin($data){

        $this->db->query('UPDATE admin SET email = :email, firstName = :firstName, lastName = :lastName, contactNumber = :contactNumber WHERE adminID = :adminID');
    
        $this->db->bind(':adminID', $data['adminID']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':firstName', $data['firstName']);
        $this->db->bind(':lastName', $data['lastName']);
        $this->db->bind(':contactNumber', $data['contactNumber']);
    
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

        $this->db->query('SELECT * FROM admin WHERE adminID = :adminID');
    
        $this->db->bind(':adminID', $adminID);
    
        $row = $this->db->single();
    
        if($this->db->rowCount() > 0){
            return $row;
        } else {
            return null;
        }
    }

    public function getVehicleRequests(){

        $this->db->query('SELECT vehicle.*, owner.firstName AS ownerFirstName, owner.lastName AS ownerLastName, owner.contactNumber AS ownerContactNumber FROM vehicle INNER JOIN owner ON vehicle.ownerID = owner.ownerID WHERE vehicle.approvedState = 0 && vehicle.pendingState = 1');

        return $this->db->resultSet();
    }

    public function getVehicleDetails($vehicleID){

        $this->db->query('SELECT vehicle.*, owner.firstName AS ownerFirstName, owner.lastName AS ownerLastName, owner.contactNumber AS ownerContactNumber FROM vehicle INNER JOIN owner ON vehicle.ownerID = owner.ownerID WHERE vehicle.vehicleID = :vehicle_id');
        
        $this->db->bind(':vehicle_id', $vehicleID);

        return $this->db->single();
    }

    public function getDriverRequests(){

        $this->db->query('SELECT driver.*, owner.firstName AS ownerFirstName, owner.lastName AS ownerLastName, owner.contactNumber AS ownerContactNumber FROM driver INNER JOIN owner ON driver.ownerID = owner.ownerID WHERE driver.approvedState = 0 && driver.pendingState = 1');

        return $this->db->resultSet();
    }

    public function getDriverDetails($driverID){

        $this->db->query('SELECT driver.*, owner.firstName AS ownerFirstName, owner.lastName AS ownerLastName, owner.contactNumber AS ownerContactNumber FROM driver INNER JOIN owner ON driver.ownerID = owner.ownerID WHERE driver.driverID = :driver_id');
        
        $this->db->bind(':driver_id', $driverID);

        return $this->db->single();
    }

    public function approveVehicle($vehicleID){
        
        $this->db->query('UPDATE vehicle SET approvedState = 1, pendingState = 0 WHERE vehicleID = :vehicle_id');
        
        $this->db->bind(':vehicle_id', $vehicleID);
    
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function rejectVehicle($vehicleID){
   
        

        //if vehicle had a driver assigned, remove the driver
        $this->db->query('UPDATE driver SET vehicleID = NULL, ownerID = NULL WHERE vehicleID = :vehicle_id');
        $this->db->bind(':vehicle_id', $vehicleID);
        $this->db->execute();

        $this->db->query('UPDATE vehicle SET driverId = NULL WHERE vehicleId = :vehicle_id');
        $this->db->bind(':vehicle_id', $vehicleID);
        $this->db->execute();

        //reject the vehicle
        $this->db->query('UPDATE vehicle SET approvedState = 0, pendingState = 0 WHERE vehicleID = :vehicle_id');
        $this->db->bind(':vehicle_id', $vehicleID);
        
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function approveDriver($driverID){
       
        $this->db->query('UPDATE driver SET approvedState = 1, pendingState = 0 WHERE driverID = :driver_id');
      
        $this->db->bind(':driver_id', $driverID);
    
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function rejectDriver($driverID){
        
        $this->db->query('UPDATE vehicle SET approvedState = 0, pendingState = 0 WHERE driverID = :driver_id');
        
        $this->db->bind(':driver_id', $driverID);
    
        if($this->db->execute()){
            return true;
        } else {
            return false; 
        }
    }

    public function getParentCount(){

        $this->db->query('SELECT COUNT(*) AS parentCount FROM parent');
    
        $result = $this->db->single();
    
        return $result->parentCount;
    }
    
    public function getOwnerCount(){

        $this->db->query('SELECT COUNT(*) AS ownerCount FROM owner');
    
        $result = $this->db->single();
    
        return $result->ownerCount;
    }
    
    public function getDriverCount(){

        $this->db->query('SELECT COUNT(*) AS driverCount FROM driver');
    
        $result = $this->db->single();
    
        return $result->driverCount;
    }

    public function getRegistrationData() {

        $currentDate = new DateTime();
        $currentDate->sub(new DateInterval('P30D'));
        $startDate = $currentDate->format('Y-m-d');
      
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
      
        $this->db->bind(':startDate', $startDate);
      
        $results = $this->db->resultSet();
      
        $formattedData = [];
        foreach ($results as $row) {
          $formattedData[] = [
            'date' => strtotime($row->date), 
            'parents' => $row->parents,
            'owners' => $row->owners,
            'drivers' => $row->drivers,
          ];
        }
      
        return $formattedData;
    }

    public function getParentRegistrationData($fromDate, $toDate) {
        $this->db->query("
            SELECT 
                p.parentID, 
                p.email, 
                p.firstName, 
                p.lastName, 
                c.name AS city, 
                p.contactNumber, 
                p.regDate
            FROM parent p
            INNER JOIN city c ON p.cityId = c.cityId  
            WHERE p.regDate BETWEEN :fromDate AND :toDate
            ORDER BY p.regDate DESC
        ");
    
        $this->db->bind(':fromDate', $fromDate);
        $this->db->bind(':toDate', $toDate);
    
        $results = $this->db->resultSet();
    
        return $results;
    }

    public function getDriverRegistrationData($fromDate, $toDate) {

        $this->db->query("
            SELECT 
                firstName, 
                lastName, 
                email, 
                nic, 
                address, 
                contactNumber, 
                regDate
            FROM driver
            WHERE regDate BETWEEN :fromDate AND :toDate
            ORDER BY regDate DESC
        ");
    
        $this->db->bind(':fromDate', $fromDate);
        $this->db->bind(':toDate', $toDate);
    
        $results = $this->db->resultSet();
    
        return $results;
    }
    
    public function getOwnerRegistrationData($fromDate, $toDate) {
        $this->db->query("
            SELECT 
                email, 
                firstName, 
                lastName, 
                contactNumber, 
                regDate
            FROM owner
            WHERE regDate BETWEEN :fromDate AND :toDate
            ORDER BY regDate DESC
        ");
    

        $this->db->bind(':fromDate', $fromDate);
        $this->db->bind(':toDate', $toDate);
    

        $results = $this->db->resultSet();
    
        return $results;
    }

    public function getIncidentReports(){

        $this->db->query('SELECT incident.*, vehicle.licensePlate, driver.firstName as driverFirstName, driver.lastName as driverLastName, parent.firstName as parentFirstName, parent.lastName as parentLastName FROM incident JOIN vehicle ON incident.vehicleID = vehicle.vehicleId JOIN driver ON vehicle.driverId = driver.driverId JOIN parent ON incident.parentID = parent.parentID ORDER BY incident.resolvedState ASC, incident.timestamp DESC');
    
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