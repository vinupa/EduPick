<?php
class Owner_
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCities()
    {
        $this->db->query('SELECT * FROM city');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getSchools()
    {
        $this->db->query('SELECT * FROM school');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getAllVehicles($owner_id)
    {
        // $this->db->query('SELECT * FROM vehicle WHERE ownerId = :owner_id');
        $this->db->query('SELECT vehicle.*, driver.firstName, driver.lastName FROM vehicle LEFT JOIN driver ON vehicle.vehicleId = driver.vehicleId WHERE vehicle.ownerId = :owner_id');
        $this->db->bind(':owner_id', $owner_id);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getLastVehicleId()
    {
        $this->db->query('SELECT MAX(vehicleId) as vehicleId FROM vehicle');
        $result = $this->db->single();
        return $result;
    }

    public function addVehicle($data)
    {
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
        if ($this->db->execute()) {
            $vehicle_id = $this->getLastVehicleId()->vehicleId;
            $this->db->query('INSERT INTO vehiclecities (vehicleId, cityId) VALUES (:vehicle_id, :city_id)');
            foreach ($data['city'] as $city) {
                $this->db->bind(':vehicle_id', $vehicle_id);
                $this->db->bind(':city_id', $city);
                $this->db->execute();
            }

            // add a query into the vehicle schools table for each school selected
            $this->db->query('INSERT INTO vehicleschools (vehicleId, schoolId) VALUES (:vehicle_id, :school_id)');
            foreach ($data['school'] as $school) {
                $this->db->bind(':vehicle_id', $vehicle_id);
                $this->db->bind(':school_id', $school);
                $this->db->execute();
            }

            return true;
        } else {
            return false;
        }
    }

    public function getDriverRequests($owner_id)
    {
        $this->db->query('SELECT drivervehiclerequest.*, driver.firstName, driver.lastName, driver.image_profilePhoto, driver.nic, driver.contactNumber, vehicle.model FROM drivervehiclerequest JOIN driver ON drivervehiclerequest.driverId = driver.driverId JOIN vehicle ON drivervehiclerequest.vehicleId = vehicle.vehicleId WHERE vehicle.ownerId = :owner_id AND drivervehiclerequest.declinedState = 0');
        $this->db->bind(':owner_id', $owner_id);
        $results = $this->db->resultSet();
        return $results;
    }

    public function acceptRequest($request_id)
    {

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

        //decline all other requests for the same vehicle
       $this->db->query('UPDATE drivervehiclerequest SET declinedState = 1 WHERE vehicleId = :vehicle_id AND declinedState = 0');
        $this->db->bind(':vehicle_id', $result->vehicleId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function declineRequest($request_id)
    {
        $this->db->query('UPDATE drivervehiclerequest SET declinedState = 1 WHERE requestId = :request_id');
        $this->db->bind(':request_id', $request_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getChildRequests($owner_id)
    {
        $this->db->query('SELECT childvehiclerequest.*, child.firstName, child.lastName, child.grade, school.name as schoolName, vehicle.model, vehicle.licensePlate, parent.firstName AS parentFirstName, parent.lastName AS parentLastName, parent.contactNumber FROM childvehiclerequest JOIN child ON childvehiclerequest.childId = child.childID JOIN vehicle ON childvehiclerequest.vehicleId = vehicle.vehicleId JOIN school ON child.schoolId = school.schoolId JOIN parent ON child.parentID = parent.parentID WHERE vehicle.ownerId = :owner_id AND childvehiclerequest.declinedState = 0');
        $this->db->bind(':owner_id', $owner_id);
        $results = $this->db->resultSet();
        return $results;
    }

    public function acceptChildRequest($request_id)
    {
        //get vehicle id and child id from the request
        $this->db->query('SELECT * FROM childvehiclerequest WHERE requestId = :request_id');
        $this->db->bind(':request_id', $request_id);
        $result = $this->db->single();

        //update the child table with vehicle id
        $this->db->query('UPDATE child SET vehicleId = :vehicle_id WHERE childID = :child_id');
        $this->db->bind(':vehicle_id', $result->vehicleId);
        $this->db->bind(':child_id', $result->childId);
        $this->db->execute();

        //reduce vacant seat count by one of vehicle (if present value is larger than 0)
        $this->db->query('UPDATE vehicle SET vacantSeats = vacantSeats - 1 WHERE vehicleId = :vehicle_id AND vacantSeats > 0');
        $this->db->bind(':vehicle_id', $result->vehicleId);
        $this->db->execute();

        //delete the request from the childvehiclerequest table
        $this->db->query('DELETE FROM childvehiclerequest WHERE requestId = :request_id');
        $this->db->bind(':request_id', $request_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function declineChildRequest($request_id)
    {
        $this->db->query('UPDATE childvehiclerequest SET declinedState = 1 WHERE requestId = :request_id');
        $this->db->bind(':request_id', $request_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getDrivers($owner_id)
    {
        $this->db->query('SELECT driver.*, vehicle.licensePlate FROM driver JOIN vehicle ON driver.vehicleId = vehicle.vehicleId WHERE vehicle.ownerId = :owner_id');
        $this->db->bind(':owner_id', $owner_id);
        $results = $this->db->resultSet();
        return $results;
    }

    public function disconnectDriver($driver_id)
    {
        $this->db->query('UPDATE driver SET vehicleId = NULL WHERE driverId = :driver_id');
        $this->db->bind(':driver_id', $driver_id);

        if ($this->db->execute()) {
            $this->db->query('UPDATE vehicle SET driverId = NULL WHERE driverId = :driver_id');
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

    public function getChildren($owner_id)
    {
        $this->db->query('SELECT child.*, parent.contactNumber, vehicle.licensePlate, city.name as city, school.name as schoolName FROM child JOIN parent ON child.parentID = parent.parentID JOIN vehicle ON child.vehicleId = vehicle.vehicleId JOIN city ON parent.cityId = city.cityId JOIN school ON child.schoolId = school.schoolId WHERE vehicle.ownerId = :owner_id');
        $this->db->bind(':owner_id', $owner_id);
        $results = $this->db->resultSet();
        return $results;
    }

    public function disconnectChild($child_id)
    {
        $this->db->query('UPDATE child SET vehicleId = NULL, ownerID = NULL WHERE childID = :child_id');
        $this->db->bind(':child_id', $child_id);

        if ($this->db->execute()) {
            $this->db->query('UPDATE vehicle SET vacantSeats = vacantSeats + 1 WHERE vehicleId = (SELECT vehicleId FROM child WHERE childID = :child_id)');
            $this->db->bind(':child_id', $child_id);
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
