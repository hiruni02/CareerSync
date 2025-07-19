<?php
    class Model{
        use Database;//so you can include multiple classes within this class
        function CreateTable(){
            
            $query = "CREATE TABLE IF NOT EXISTS Accounts (
                        ID int AUTO_INCREMENT primary key,
                        Name varchar(50) not null
                        )";
            $this->query($query);
        }
        function SelectTable(){
            $query ="SELECT * FROM Accounts";
            $result = $this->query($query);
            show($result);
        }

    }