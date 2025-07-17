<?php
    

    class Database{
        private function connect(){
            $conn = new mysqli(DBHOST, DBUSER, DBPASS);
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }
            return $conn;
        }
        public function query($query,$data=[]){
            $conn = $this->connect();
            $stmt = $conn->prepare($query);
            $check = $stmt->execute($data);
            if($check){
                $result = $stmt->fetchAll(mysqli::FETCH_OBJ);
                if(is_array($check)&&count($result)){
                    return $result;
                }
            }
            return false;
        }
    }
