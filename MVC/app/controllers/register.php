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
                            $validator = new Validator;

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
                                        'contactNo' => $_POST['contactNo'],
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
                        
                        case 'counselor':
                            $counselor = new Counselor;

                                $photo_upload_path = $_SERVER['DOCUMENT_ROOT'] . '/CareerSync/MVC/public/assets/uploads/counselor_photos/';
                                $certificate_upload_path = $_SERVER['DOCUMENT_ROOT'] . '/CareerSync/MVC/public/assets/uploads/counselor_certificates/';

                                // Create unique file names
                                $photo_filename = time() . '_' . basename($_FILES['counselor_photo_path']['name']);
                                $certificate_filename = time() . '_' . basename($_FILES['certificate']['name']);
                                $photo_target = $photo_upload_path . $photo_filename;
                                $certificate_target = $certificate_upload_path . $certificate_filename;

        
                                if(move_uploaded_file($_FILES['counselor_photo_path']['tmp_name'], $photo_target) &&
                                   move_uploaded_file($_FILES['certificate']['tmp_name'], $certificate_target)) {
                                   $user->insert($userTableData);
                                   $newUser = $user->first(['email' => $_POST['email']]);

                                    // Insert into career_counselors table
                                    $counselorData = [
                                        'user_id'         => $newUser->user_id,
                                        'firstName'      => $_POST['firstName'],
                                        'lastName'       => $_POST['lastName'],
                                        'contactNo'            => $_POST['contactNo'],
                                        'counselor_photo_path' => $photo_target,
                                        'certificate_path'     => $certificate_target,
                                    ];
                                    $counselor->insert($counselorData);

                                    redirect('login');
                                    exit;
                                } else {
                                    $user->errors['file_upload'] = "Failed to upload proof or certificate file";
                                }
                            
                        break;
                        /*case 'candidate':
                        break;*/
                    }
                }
                

                // Send errors to the view
                $data['errors'] = $user->errors;
            }
            $this->view("register", $data);
        }
    }