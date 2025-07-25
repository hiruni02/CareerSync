<?php
    class Home extends Controller{
        public function index(){
            //db test
            $user = new User;
            $user->CreateTables();
            
            //$arr['name']='jack';
            //$user->insert($arr);
            //$result = $user->SelectAll();
            //show($result);
            
            $arr['email']='anuk.Thotawatta@gmail.com';
            $arr['password']='1234';
            $arr['role']='admin';
            $arr['status']='active';

            $user->insert($arr);
            //$result = $user->SelectAll();
            //show($result);

            $this->view("home");
        }
    }
    #if you need to load a view, there must be a controller for that view in the controller folder calling the view functuon from the Controller class
    #And that will load a the [view name].view.php or it will load the error 404 view.
    