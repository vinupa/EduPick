<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Register Parent
    public function registerParent($data)
    {
        $this->db->query('INSERT INTO parent (firstName, lastName, email, `password`, contactNumber, cityId) VALUES(:first_name, :last_name, :email, :pswd, :contact_number, :city)');
        // Bind values
        $this->db->bind(':first_name', $data['fname']);
        $this->db->bind(':last_name', $data['lname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pswd', $data['password']);
        $this->db->bind(':contact_number', $data['contact_number']);
        $this->db->bind(':city', $data['city']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Register Parent
    public function registerOwner($data)
    {
        $this->db->query('INSERT INTO `owner` (firstName, lastName, email, `password`, contactNumber) VALUES(:first_name, :last_name, :email, :pswd, :contact_number)');
        // Bind values
        $this->db->bind(':first_name', $data['fname']);
        $this->db->bind(':last_name', $data['lname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pswd', $data['password']);
        $this->db->bind(':contact_number', $data['contact_number']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // Register Driver
    public function registerDriver($data)
    {
        $this->db->query('INSERT INTO driver (firstName, lastName, email, `password`, contactNumber, `address`) VALUES(:first_name, :last_name, :email, :pswd, :contact_number, :addrs)');
        // Bind values
        $this->db->bind(':first_name', $data['fname']);
        $this->db->bind(':last_name', $data['lname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pswd', $data['password']);
        $this->db->bind(':contact_number', $data['contact_number']);
        $this->db->bind(':addrs', $data['address']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function adminRegister($data)
    {
        $this->db->query('INSERT INTO admin (firstName, lastName, email, contactNumber, password) VALUES(:first_name, :last_name, :email, :contact_number, :password)');
        // Bind values
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':contact_number', $data['contact_number']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Find User by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM parent WHERE email = :email');
        // Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {

            $this->db->query('SELECT * FROM `owner` WHERE email = :email');
            // Bind value
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // Check row
            if ($this->db->rowCount() > 0) {
                return true;
            } else {

                $this->db->query('SELECT * FROM driver WHERE email = :email');
                // Bind value
                $this->db->bind(':email', $email);

                $row = $this->db->single();

                // Check row
                if ($this->db->rowCount() > 0) {
                    return true;
                } else {

                    $this->db->query('SELECT * FROM `admin` WHERE email = :email');
                    // Bind value
                    $this->db->bind(':email', $email);

                    $row = $this->db->single();

                    // Check row
                    if ($this->db->rowCount() > 0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        }
    }

    // Login User
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM parent WHERE email = :email');
        // Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                $row->type = 'parent';
                return $row;
            } else {
                return false;
            }
        } else {

            $this->db->query('SELECT * FROM `owner` WHERE email = :email');
            // Bind value
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // Check row
            if ($this->db->rowCount() > 0) {
                $hashed_password = $row->password;
                if (password_verify($password, $hashed_password)) {
                    $row->type = 'owner';
                    return $row;
                } else {
                    return false;
                }
            } else {

                $this->db->query('SELECT * FROM driver WHERE email = :email');
                // Bind value
                $this->db->bind(':email', $email);

                $row = $this->db->single();

                // Check row
                if ($this->db->rowCount() > 0) {
                    $hashed_password = $row->password;
                    if (password_verify($password, $hashed_password)) {
                        $row->type = 'driver';
                        return $row;
                    } else {
                        return false;
                    }
                } else {

                    $this->db->query('SELECT * FROM `admin` WHERE email = :email');
                    // Bind value
                    $this->db->bind(':email', $email);

                    $row = $this->db->single();

                    // Check row
                    if ($this->db->rowCount() > 0) {
                        $hashed_password = $row->password;
                        if (password_verify($password, $hashed_password)) {
                            $row->type = 'admin';
                            return $row;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }
            }
        }
    }

    public function getCities()
    {
        $this->db->query('SELECT * FROM city');
        $results = $this->db->resultSet();

        return $results;
    }
}
