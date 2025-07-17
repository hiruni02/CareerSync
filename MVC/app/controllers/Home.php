<?php
    class Home extends Controller{
        public function index(){
            //db test
            $model = new Model;
            $model->test();

            $this->view("home");
        }
    }
    #if you need to load a view, there must be a controller for that view in the controller folder calling the view functuon from the Controller class
    #And that will load a the [view name].view.php or it will load the error 404 view.
    