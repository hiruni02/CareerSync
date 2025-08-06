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
                $role = $_GET['role'] ?? null;
                if ($role) {
                    $_POST['role'] = $role;
                }

                //Check if email already exists
                $email_existing = $user->first(['email' => $_POST['email']]);
                if ($email_existing) {
                    $user->errors['email'] = "Email already exists";
                }
                else if($_POST['confirm_password'] !== $_POST['password']){
                    $user->errors['confirm_password'] = "passwords do not match";
                }
                else{
                    $userTableData = $_POST;
                    //updating validator table fields
                    switch($role){
                        case 'validator':
                            $validator = new validator;

                            $nic_existing = $validator->first(['nic_no' => $_POST['nic_no']]);
                            if ($nic_existing) {
                                $user->errors['nic_no'] = "NIC number already exists";
                            }
                            else{
                                $upload_path = $_SERVER['DOCUMENT_ROOT'] . '/CareerSync/MVC/public/assets/uploads/validator_ids/';
                                $filename = time() . '_' . basename($_FILES['nic_path']['name']);//makes each upload file name unique
                                $target_file = $upload_path . $filename;

                                if (move_uploaded_file($_FILES['nic_path']['tmp_name'], $target_file)) {
                                    $user->insert($userTableData);
                                    $newUser = $user->first(['email' => $_POST['email']]);

                                    // Insert into validator table
                                    $validatorData = [
                                        'user_id'   => $newUser->user_id,
                                        'firstName' => $_POST['firstName'],
                                        'lastName'  => $_POST['lastName'],
                                        'phoneNo'   => $_POST['phoneNo'],
                                        'nic_no'    => $_POST['nic_no'],
                                        'nic_path'  => $target_file,
                                    ];
                                    $validator->insert($validatorData);

                                    redirect('login');
                                    exit;
                                } else {
                                    $user->errors['nic_path'] = "Failed to upload NIC photo";
                                }
                            }
                        break;
                        /*
                        case 'company':
                        break;

                        case 'conunselor':
                        break;

                        case 'candidate':
                        break;*/
                    }
                }
                

                // Send errors to the view
                $data['errors'] = $user->errors;
            }
            $this->view("register", $data);
        }
    }