<?php
    class contact{
        use Controller;
        public function index(){
            $this->view("contact");
        }
    }