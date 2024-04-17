<?php
    class Parent_ {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getChildren($parent_id){
            $this->db->query('SELECT * FROM child WHERE parentID = :parent_id AND isDeleted = 0');
            $this->db->bind(':parent_id', $parent_id);

            $results = $this->db->resultSet();

            return $results;
        }

        public function addChild($data){
            $this->db->query('INSERT INTO child (firstName, lastName, school, grade, parentID, absentState) VALUES (:fname, :lname, :school, :grade, :parentID, 0)');
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
            $this->db->query('SELECT * FROM child WHERE childID = :child_id AND isDeleted = 0');
            $this->db->bind(':child_id', $child_id);

            $row = $this->db->single();

            return $row;
        }

        public function updateChild($data){
            $this->db->query('UPDATE child SET firstName = :fname, lastName = :lname, school = :school, grade = :grade WHERE childID = :child_id');
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

        public function getParent($parent_id){
            $this->db->query('SELECT * FROM parent WHERE parentID = :parent_id');
            $this->db->bind(':parent_id', $parent_id);

            $row = $this->db->single();

            return $row;
        }

    }