<?php
    trait Model{
        use Database;//so you can include multiple classes within this class
        
        protected $limit = 10;
        protected $offset = 0;
        protected $order_type = "asc";
        protected $order_column = "user_id";
        public $errors = [];

        //hardcoded function to create the entire database
        public function CreateTables(){
            $user_table = "CREATE TABLE IF NOT EXISTS users (
                        user_id INT AUTO_INCREMENT PRIMARY KEY,
                        email VARCHAR(100) NOT NULL UNIQUE,
                        password VARCHAR(255) NOT NULL,
                        role ENUM('candidate', 'counselor', 'company', 'validator', 'admin') NOT NULL,
                        status ENUM('active', 'inactive', 'pending') DEFAULT 'pending',
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
            $this->query($user_table);
          
            $company_table = "CREATE TABLE IF NOT EXISTS company (
                      user_id INT AUTO_INCREMENT PRIMARY KEY,
                      companyname VARCHAR(100),
                      email VARCHAR(100) NOT NULL UNIQUE,
                      contactNo VARCHAR(15),
                      password VARCHAR(255) NOT NULL,
                      FOREIGN KEY (user_id) REFERENCES users(user_id)
                   )";
            $this->query($company_table);
          
            $counselor_table = "CREATE TABLE IF NOT EXISTS career_counselors( 
                        user_id INT AUTO_INCREMENT PRIMARY KEY,
                        first_name VARCHAR(100) NOT NULL,
                        last_name VARCHAR(100) NOT NULL,
                        contactNo VARCHAR(10) NOT NULL, 
                        counselor_photo_path VARCHAR(1000) NOT NULL UNIQUE,
                        certificate_path VARCHAR(1000) NOT NULL UNIQUE,
                        FOREIGN KEY (user_id) REFERENCES users(user_id)
                    )";
            $this->query($counselor_table);

            $validator_table = "CREATE TABLE IF NOT EXISTS validator(
                        user_id INT AUTO_INCREMENT PRIMARY KEY,
                        firstName VARCHAR(100) NOT NULL,
                        lastName VARCHAR(100) NOT NULL,
                        contactNo VARCHAR(10) NOT NULL , 
                        nic_no INT NOT NULL UNIQUE,
                        nic_path VARCHAR(1000) NOT NULL UNIQUE,
                        FOREIGN KEY (user_id) REFERENCES users(user_id)
                    )";
            $this->query($validator_table);

            $candidate_table = "CREATE TABLE IF NOT EXISTS candidate (
                        user_id INT PRIMARY KEY,
                        firstName VARCHAR(100)NOT NULL,
                        lastName VARCHAR(100)NOT NULL,
                        DOB DATETIME NOT NULL ,
                        address VARCHAR(100)NOT NULL,
                        contactNo VARCHAR(10)NOT NULL,
                        candidate_photo_path VARCHAR(1000) NOT NULL UNIQUE,
                        FOREIGN KEY (user_id) REFERENCES users(user_id)
                    )";
            
            $this->query($candidate_table);
        }
        public function SelectAll(){
            $query ="SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
            $result = $this->query($query);
            show($result);
        }
        public function where($data,$data_not = []){
            $keys = array_keys($data);
            $keys_not = array_keys($data_not);
            $query = "select * from $this->table where ";
            foreach($keys as $key){
                $query .= $key . "=? AND ";
            }
            foreach($keys_not as $key){
                $query .= $key . "!=? AND ";
            }
            $query = rtrim($query," AND ");
            $query .= "ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
            $data = array_merge($data,$data_not);
            return $this->query($query,$data);
        }
        public function first($data,$data_not = []){
            $keys = array_keys($data);
            $keys_not = array_keys($data_not);
            $query = "select * from $this->table where ";
            foreach($keys as $key){
                $query .= $key . "=? AND ";
            }
            foreach($keys_not as $key){
                $query .= $key . "!=? AND ";
            }
            $query = rtrim($query," AND ");
            $query .= " LIMIT $this->limit OFFSET $this->offset";
            $data = array_merge($data,$data_not);
            $result = $this->query($query,$data);
            if($result){
                return $result[0];
            }
            return false;
        }
        public function insert($data){
            if(!empty($this->allowedColumns)){//remove unwanted data
                foreach($data as $key => $value){
                    if(!in_array($key,$this->allowedColumns)){
                        unset($data[$key]);
                    }
                }
            }
            $keys = array_keys($data);
            
            $query = "INSERT INTO $this->table (".implode(",",$keys).") VALUES (" . implode(",", array_fill(0, count($keys), "?")) . ")";
            //echo $query;
            $this->query($query,$data);
            return false;
        }
        public function update($id,$data,$id_column='id'){
            if(!empty($this->allowedColumns)){//remove unwanted data
                foreach($this->data as $key => $value){
                    if(!in_array($key,$this->allowedColumns)){
                        unset($data[$key]);
                    }
                }
            }
            $keys = array_keys($data);
            $query = "UPDATE $this->table SET ";
            foreach($keys as $key){
                $query .= $key . "=? , ";
            }
            $query = rtrim($query,", ");
            $query .= " WHERE $id_column = ?";
            $data[$id_column] = $id;
            //echo $query;
            $this->query($query,$data);
            return false;
        }
        public function delete($id,$id_column='id'){
            $data[$id_column] = $id;
            $query = "DELETE FROM $this->table WHERE $id_column = ?";
            //echo $query;
            $this->query($query,$data);
            return false;
        }

    }