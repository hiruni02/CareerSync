<?php
trait Model {
    use Database;

    protected $limit = 10;
    protected $offset = 0;

    public function CreateTable(){
        $query = "CREATE TABLE IF NOT EXISTS users (
                    ID int AUTO_INCREMENT primary key,
                    Name varchar(50) not null
                  )";
        $this->query($query);
    }

    public function CreateAdminTable(){
        $query = "CREATE TABLE IF NOT EXISTS admins (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    first_name VARCHAR(50) NOT NULL,
                    last_name VARCHAR(50) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                  )";
        $this->query($query);
    }

    public function CreateCandidateTable(){
        $query = "CREATE TABLE IF NOT EXISTS candidates (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    first_name VARCHAR(50) NOT NULL,
                    last_name VARCHAR(50) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    phone VARCHAR(20) NOT NULL,
                    role VARCHAR(50) NOT NULL,
                    cv_path VARCHAR(255),
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                  )";
        $this->query($query);
    }

    public function CreateValidationTeamTable(){
        $query = "CREATE TABLE IF NOT EXISTS validation_team (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    first_name VARCHAR(50) NOT NULL,
                    last_name VARCHAR(50) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                  )";
        $this->query($query);
    }

    public function CreateCompanyTable(){
        $query = "CREATE TABLE IF NOT EXISTS companies (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    company_name VARCHAR(100) NOT NULL,
                    company_email VARCHAR(100) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    contact_person_name VARCHAR(100) NOT NULL,
                    phone VARCHAR(20),
                    website VARCHAR(255),
                    position VARCHAR(50),
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                  )";
        $this->query($query);
    }

    public function CreateCounselorTable(){
        $query = "CREATE TABLE IF NOT EXISTS counselors (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    first_name VARCHAR(50) NOT NULL,
                    last_name VARCHAR(50) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    phone VARCHAR(20) NOT NULL,
                    qualification VARCHAR(100) NOT NULL,
                    specialization VARCHAR(100) NOT NULL,
                    resume_path VARCHAR(255),
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                  )";
        $this->query($query);
    }

    public function SelectTable(){
        $query ="SELECT * FROM Accounts";
        $result = $this->query($query);
        show($result);
    }

    public function where($data,$data_not = []){
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";
        foreach($keys as $key){
            $query .= $key . "=? AND ";
        }
        foreach($keys_not as $key){
            $query .= $key . "!=? AND ";
        }
        $query = rtrim($query," AND ");
        $query .= " LIMIT $this->limit OFFSET $this->offset";
        $data = array_merge($data,$data_not);
        return $this->query($query,$data);
    }

    public function first($data,$data_not = []){
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";
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
        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (".implode(",",$keys).") VALUES (" . implode(",", array_fill(0, count($keys), "?")) . ")";
        $this->query($query,$data);
        return false;
    }

    public function update($id,$data,$id_column='id'){
        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";
        foreach($keys as $key){
            $query .= $key . "=? , ";
        }
        $query = rtrim($query,", ");
        $query .= " WHERE $id_column = ?";
        $data[$id_column] = $id;
        $this->query($query,$data);
        return false;
    }

    public function delete($id,$id_column='id'){
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = ?";
        $this->query($query,$data);
        return false;
    }
}
