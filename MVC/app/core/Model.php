<?php
trait Model
{
    use Database; //so you can include multiple classes within this class

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "asc";
    protected $order_column = "user_id";
    public $errors = [];

    //hardcoded function to create the entire database
    public function CreateTables()
    {
        $user_table = "CREATE TABLE IF NOT EXISTS users (
                        user_id INT AUTO_INCREMENT PRIMARY KEY,
                        email VARCHAR(100) NOT NULL UNIQUE,
                        password VARCHAR(255) NOT NULL,
                        role ENUM('candidate', 'counselor', 'company', 'validator', 'admin') NOT NULL,
                        status ENUM('active', 'inactive', 'pending') DEFAULT 'pending',
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";
        $this->query($user_table);

        $admin_table = "CREATE TABLE IF NOT EXISTS admin (
                        user_id INT PRIMARY KEY,
                        firstName VARCHAR(100) NOT NULL,
                        lastName VARCHAR(100) NOT NULL,
                        contactNo VARCHAR(10) NOT NULL,
                        admin_photo_path VARCHAR(255) NOT NULL,
                        FOREIGN KEY (user_id) REFERENCES users(user_id)
                   )";
        $this->query($admin_table);

        $admin_email = 'admin@gmail.com';
        $admin_password = 'root'; // need to hash this for futher protection

        $check_admin = "SELECT COUNT(*) AS total_rows FROM users";
        $result = $this->query($check_admin);

        if ($result && isset($result[0]->total_rows) && $result[0]->total_rows == 0) {
            $insert_user = "INSERT INTO users (email, password, role, status) VALUES (?, ?, 'admin', 'active')";
            $this->query($insert_user, [$admin_email, $admin_password]);

            $user_id = 1;
            $insert_admin = "INSERT INTO admin (user_id, firstName, lastName, contactNo, admin_photo_path) 
                     VALUES (?, 'root', 'root', '0712345678', 'assets/uploads/defaultPhoto.jpg')";
            $this->query($insert_admin, [$user_id]);
        }

        $company_table = "CREATE TABLE IF NOT EXISTS company(
                        user_id INT PRIMARY KEY,
                        companyName VARCHAR(100) NOT NULL,
                        contactNo VARCHAR(15) NOT NULL,
                        hr_firstName VARCHAR(100) NOT NULL,
                        hr_lastName VARCHAR(100) NOT NULL,
                        hr_email VARCHAR(100) NOT NULL,
                        hr_contactNo VARCHAR(15) NOT NULL,
                        business_certificate VARCHAR(255) NOT NULL UNIQUE,
                        company_photo_path VARCHAR(1000) NOT NULL UNIQUE,
                        FOREIGN KEY (user_id) REFERENCES users(user_id)
                    )";
        $this->query($company_table);


        $counselor_table = "CREATE TABLE IF NOT EXISTS counselor( 
                        user_id INT PRIMARY KEY,
                        firstName VARCHAR(100) NOT NULL,
                        lastName VARCHAR(100) NOT NULL,
                        contactNo VARCHAR(10) NOT NULL, 
                        counselor_photo_path VARCHAR(1000) NOT NULL UNIQUE,
                        certificate_path VARCHAR(1000) NOT NULL UNIQUE,
                        FOREIGN KEY (user_id) REFERENCES users(user_id)
                    )";
        $this->query($counselor_table);

        $validator_table = "CREATE TABLE IF NOT EXISTS validator(
                        user_id INT PRIMARY KEY,
                        firstName VARCHAR(100) NOT NULL,
                        lastName VARCHAR(100) NOT NULL,
                        contactNo VARCHAR(10) NOT NULL , 
                        validator_photo_path VARCHAR(1000) NOT NULL UNIQUE,
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

        $jobPost_table = "CREATE TABLE IF NOT EXISTS jobPost (
                        job_id INT AUTO_INCREMENT PRIMARY KEY,
                        company_id INT NOT NULL,
                        posTitle VARCHAR(100)NOT NULL,
                        posType ENUM('intern','fullTime','partTime','freelance','contract')NOT NULL,
                        industry VARCHAR(100)NOT NULL,
                        exp_level ENUM('entry','mid','senior')NOT NULL,
                        yearsOfExp VARCHAR(100)NOT NULL,
                        qualifications VARCHAR(1000),
                        required_skills VARCHAR(1000),
                        salaryDetails INT NOT NULL,
                        address VARCHAR(1000)NOT NULL,
                        city VARCHAR(100)NOT NULL,
                        workMode ENUM('online','offline','hybrid')NOT NULL,
                        jobDescription VARCHAR(1000)NOT NULL,
                        vacancies INT NOT NULL,
                        deadline date NOT NULL,
                        status ENUM('open','closed') DEFAULT 'open',
                        posted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (company_id) REFERENCES users(user_id)
                    )";
        $this->query($jobPost_table);

        $cv_table = "CREATE TABLE IF NOT EXISTS cvTable (
                        cv_id INT AUTO_INCREMENT PRIMARY KEY,
                        job_id INT,
                        candidate_id INT NOT NULL,
                        cv_file_path VARCHAR(1000) NOT NULL UNIQUE,
                        applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        validator_approval ENUM('approved', 'pending', 'rejected') DEFAULT 'pending',
                        FOREIGN KEY (job_id) REFERENCES jobPost(job_id),
                        FOREIGN KEY (candidate_id) REFERENCES candidate(user_id)
                    )";
        $this->query($cv_table);

        $interviews_table = "CREATE TABLE IF NOT EXISTS interviews (
                        interview_id INT AUTO_INCREMENT PRIMARY KEY,
                        candidate_id INT,
                        company_id INT,
                        mode ENUM('online','offline') NOT NULL,
                        address_link VARCHAR(255) NOT NULL,
                        extra_details TEXT,
                        FOREIGN KEY (candidate_id) REFERENCES candidate(user_id),
                        FOREIGN KEY (company_id) REFERENCES company(user_id)
                    )";
        $this->query($interviews_table);

        $interview_slot_table = "CREATE TABLE IF NOT EXISTS interview_slots (
                        slot_id INT AUTO_INCREMENT PRIMARY KEY,
                        interview_id INT,
                        slot_datetime DATETIME,
                        FOREIGN KEY (interview_id) REFERENCES interviews(interview_id)
                        )";
        $this->query($interview_slot_table);
    }

    public function SelectAll()
    {
        $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        $result = $this->query($query);
        return $result;
    }
    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        foreach ($keys as $key) {
            $query .= $key . "=? AND ";
        }
        foreach ($keys_not as $key) {
            $query .= $key . "!=? AND ";
        }
        $query = rtrim($query, " AND ");
        $query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        $data = array_merge($data, $data_not);
        return $this->query($query, $data);
    }

    //this is the new first function prevents incorrect SQL syntax when params are empty
    public function first($data = [], $data_not = [])
    {
        $query = "SELECT * FROM $this->table";
        $params = [];
        $conditions = [];
        foreach ($data as $key => $value) {
            $conditions[] = "$key = ?";
            $params[] = $value;
        }
        foreach ($data_not as $key => $value) {
            $conditions[] = "$key != ?";
            $params[] = $value;
        }
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
        $query .= " LIMIT $this->limit OFFSET $this->offset";
        $result = $this->query($query, $params);
        return $result ? $result[0] : false;
    }
    public function insert($data)
    {
        if (!empty($this->allowedColumns)) { //remove unwanted data
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);

        $query = "INSERT INTO $this->table (" . implode(",", $keys) . ") VALUES (" . implode(",", array_fill(0, count($keys), "?")) . ")";
        //echo $query;
        $this->query($query, $data);
        return false;
    }
    public function update($id, $data, $id_column = 'id')
    {
        if (!empty($this->allowedColumns)) { //remove unwanted data
            foreach ($this->data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";
        foreach ($keys as $key) {
            $query .= $key . "=? , ";
        }
        $query = rtrim($query, ", ");
        $query .= " WHERE $id_column = ?";
        $data[$id_column] = $id;
        //echo $query;
        $this->query($query, $data);
        return false;
    }
    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = ?";
        //echo $query;
        $this->query($query, $data);
        return false;
    }
}
