<?php
class Admin_ {
    private $db;

    public function __construct(){
        $this->db = new Database;
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
}
?>  