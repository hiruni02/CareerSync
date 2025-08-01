<?php
    class register{
        use Controller;
        public function index(){
            $user = new User;
            $data = [];

            //if not logged in the $username variable is deafulted to 'User'
            $data['username'] = empty($_SESSION['USER']) ? 'User' :$_SESSION['USER']->email;
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Add role to POST
                if (isset($_GET['role'])) {
                    $_POST['role'] = $_GET['role'];
                }

                //Check if email already exists
                $existing = $user->first(['email' => $_POST['email']]);

                if ($existing) {
                    $user->errors['email'] = "Email already exists";
                }
                else if($_POST['confirm_password'] !== $_POST['password']){
                    $user->errors['confirm_password'] = "passwords do not match";
                }
                else{
                    $user->insert($_POST);
                    redirect('login');
                    exit;
                }

                

                // Send errors to the view
                $data['errors'] = $user->errors;
            }
            $this->view("register", $data);
        }
    }