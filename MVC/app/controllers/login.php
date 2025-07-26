<?php
    class login{
        use Controller;
        public function index(){
            $this->view("login");
        }
    }