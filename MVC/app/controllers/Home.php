<?php
    class Home{
        use Controller;
        public function index(){
            
            $user = new User;
            $user->CreateTables();

            $this->view("home");
        }
    }
    #if you need to load a view, there must be a controller for that view in the controller folder calling the view functuon from the Controller class
    #And that will load a the [view name].view.php or it will load the error 404 view.
    