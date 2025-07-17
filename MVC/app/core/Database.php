<?php
    trait Database{  //a trait cant run on its own unless used within another class
        private function connect(){
            $conn = new mysqli(DBHOST, DBUSER, DBPASS);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            return $conn;
        }
        public function query($query,$data=[]){
            $conn = $this->connect();
            $stmt = $conn->prepare($query);
            if(!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            // Bind parameters if data is provided
            if (!empty($data)) {
                // Generate types string
                $types = '';
                foreach ($data as $param) {
                    if (is_int($param)) $types .= 'i';
                    elseif (is_double($param)) $types .= 'd';
                    elseif (is_string($param)) $types .= 's';
                }
                $stmt->bind_param($types, ...$data);
            }
            $check = $stmt->execute();
            if (stripos(trim($query), "SELECT") === 0) {
                $result = $stmt->get_result();
                $rows = [];
                if ($result) {
                    while ($row = $result->fetch_object()) {
                        $rows[] = $row;
                    }
                    return $rows ?: false;
                }
            }
            return false;
        }
    }
