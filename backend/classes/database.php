<?php 

    Class Database {

        //public $conn;

        public function __construct() {
            //$this->conn = $this->connect();
        }

        // connect to db
        private function connect() {
            try {
                return new mysqli('localhost', 'root', '', 'chat');
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            return false; // if somehow it still fail
        }

        // cho hàm bind_param ('type', 'value')
        private function getTypeOfFields($string, $fields) {
            if(is_float($fields)) {
                $string .= "d";
            } elseif(is_integer($fields)) {
                $string .= "i";
            } elseif(is_string($fields)) {
                $string .= "s";
            } else {
                $string .= "b";
            }
            return $string;
        }

        // Để thêm sửa xóa xem data
        public function makeQuery($query, array $fields = NULL) { // NULL because sometimes there will be no params

            $conn = $this->connect();

            // prepare stmt
            $stmt = $conn->prepare($query);

            if ($fields != NULL) {
                $type = array_reduce($fields, array($this, "getTypeOfFields"));
                $stmt->bind_param($type, ...$fields);
            }

            // execute
            $check = $stmt->execute();
            
            if ($check) {
                return true;
            }

            return false;

        }

        // function for select queriessssssss
        public function selectQuery($query, array $fields = NULL) { // return array

            $conn = $this->connect();

            // prepare stmt
            $stmt = $conn->prepare($query);

            if ($fields != NULL) {
                $type = array_reduce($fields, array($this, "getTypeOfFields"));
                $stmt->bind_param($type, ...$fields);
            }

            // execute
            $stmt->execute();
            $result = $stmt->get_result(); // get the mysqli result
               
            $records = [];
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }

            return $records;
        }

        // function for getting a user
        public function getUser($userid) { // return array

            $conn = $this->connect();

            $query = "SELECT * FROM users WHERE userID = ? LIMIT 1;";

            

            // prepare stmt
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $userid);

            // execute
            $stmt->execute();
            $result = $stmt->get_result(); // get the mysqli result
               
            $records = [];
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }

            return $records;
        }

        // generate num
        public function generateID($max_num) {
            $rand_num = "";
            $count = rand(4, $max_num);
            for ($i=0; $i < $count; $i++) { 
                
                $r = rand(0, 9);
                $rand_num .= $r;
            }

            return $rand_num;
        }

    }

