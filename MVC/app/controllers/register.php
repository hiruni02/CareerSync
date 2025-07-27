<?php
    class register{
        use Controller;
        public function index(){
            $user = new User;
            $data = [];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Add role to POST
                if (isset($_GET['role'])) {
                    $_POST['role'] = $_GET['role'];
                }

                //Check if email already exists
                $existing = $user->first(['email' => $_POST['email']]);

                if ($existing) {
                    $user->errors['email'] = "Email already exists";
                } else {
                    $user->insert($_POST);
                    header("Location: " . ROOT . "home");
                    exit;
                }

                // Send errors to the view
                $data['errors'] = $user->errors;
            }

            $this->view("register", $data);
        }
    }