<?php
    trait Model{
        use Database;//so you can include multiple classes within this class
        
        protected $limit = 10;
        protected $offset = 0;

        public function CreateTable(){
            $query = "CREATE TABLE IF NOT EXISTS users (
                        ID int AUTO_INCREMENT primary key,
                        Name varchar(50) not null
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
            $keys = array_keys($data);
            
            $query = "INSERT INTO $this->table (".implode(",",$keys).") VALUES (" . implode(",", array_fill(0, count($keys), "?")) . ")";
            //echo $query;
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