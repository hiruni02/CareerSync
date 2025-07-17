<?php
    class Model{
        use Database;//so you can include multiple classes within this class
        function test(){
            $query = "create database if not exists ".DBNAME;
            $result = $this->query($query);
            show($result);
        }
    }