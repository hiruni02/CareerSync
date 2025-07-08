<?php
    class Home extends Controller{
        public function index(){
            echo "This is the home controller working within the class";
        }
    }
    $home = new Home;
    $home->index(); 