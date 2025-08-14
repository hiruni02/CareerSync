<?php
    class Home{
        use Controller;
        public function index(){
            //if not logged in the $username variable is deafulted to 'User'
            $data['username'] = empty($_SESSION['USER']) ? 'User' :$_SESSION['USER']->companyname;

            $user = new User;
            $user->CreateTables();

            $this->view("home",$data);
        }
    }
    #if you need to load a view, there must be a controller for that view in the controller folder calling the view functuon from the Controller class
    #And that will load a the [view name].view.php or it will load the error 404 view.
    