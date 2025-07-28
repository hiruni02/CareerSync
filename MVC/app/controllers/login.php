<?php
    class login{
        use Controller;
        public function index(){
            $user = new User;
            $data=[];
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $row = $user->first(['email' => $_POST['email']]);
                if($row){
                    if($row->password==$_POST['password']){
                        echo "<h1> LOGGED IN</h>";
                        //header("Location: " . ROOT . "home");
                        exit;
                    }
                    else{
                        $user->errors['password'] = "Incorrect password";
                        //echo $user->errors['password'];
                    }
                }
                else{
                    $user->errors['email'] = "Email doesnt exist";
                    //echo $user->errors['email'];
                }
                //Send errors to the view
                $data['errors'] = $user->errors;

            }
            

            $this->view("login",$data);
        }
    }