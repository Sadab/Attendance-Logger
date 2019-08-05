<?php
    class Record{
        private $conn;
        private $table = 'record';

        public $id;
        public $time;

        public function __construct($db) {
            $this -> conn = $db;
        }

        public function getAllData(){
            $query = 'SELECT * FROM ' . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function getSingleUserData(){
            $query = 'SELECT * FROM record WHERE id = ?';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->time = $row['time'];
        }

        public function logAttendance(){
            $query = 'INSERT INTO record SET id = :id, time = :time';
            $query2 = 'SELECT * FROM record WHERE id = :id';
            $stmt = $this->conn->prepare($query);
            $stmt2 = $this->conn->prepare($query2);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':time', $this->time);
            $stmt2->bindParam(':id', $this->id);
            $stmt2->execute();
            $rows = $stmt2->fetchColumn();

            if ($rows > 0){
                if($stmt->execute()){
                    return true;
                }
            } else {
                printf("Error: %s, \n", $stmt->error);
                return false;
            }
        }
    }