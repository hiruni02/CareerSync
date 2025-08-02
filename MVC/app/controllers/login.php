<?php
    class login{
        use Controller;
        public function index(){
            $user = new User;
            $data=[];

            //if not logged in the $username variable is deafulted to 'User'
            $data['username'] = empty($_SESSION['USER']) ? 'User' :$_SESSION['USER']->email;

            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                $row = $user->first(['email' => $_POST['email']]);
                if($row){
                    if($row->password===$_POST['password']){
                        //echo "<h1> LOGGED IN</h>";
                        $_SESSION['USER'] = $row;
                        redirect('home');
                        exit;
                    }
                    else{
                        $user->errors['password'] = "Incorrect password";
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