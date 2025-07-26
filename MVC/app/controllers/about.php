<?php
    class about{
        use Controller;
        public function index(){
            $this->view("about");
        }
    }