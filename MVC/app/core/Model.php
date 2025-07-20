<?php
    class Model{
        use Database;//so you can include multiple classes within this class
        protected $table = 'Accounts';
        protected $limit = 10;
        protected $offset = 0;

        public function CreateTable(){
            $query = "CREATE TABLE IF NOT EXISTS Accounts (
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
        public function first($data){
            
        }
        public function insert($data){

        }
        public function update($id,$data,$id_column='id'){
            
        }
        public function delete($id,$id_column='id'){
            
        }

    }