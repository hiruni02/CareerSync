<?php
    class welcome{
        use Controller;
        public function index(){
            $this->view("welcome");
        }
    }