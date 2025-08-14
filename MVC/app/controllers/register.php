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

                            $upload_path = $_SERVER['DOCUMENT_ROOT'] . '/CareerSync/MVC/public/assets/uploads/validator_photos/';
                            $filename = time() . '_' . basename($_FILES['validator_photo_path']['name']);//makes each upload file name unique
                            $photo_target = $upload_path . $filename;

                            if (move_uploaded_file($_FILES['validator_photo_path']['tmp_name'], $photo_target)) {
                                $user->insert($userTableData);
                                $newUser = $user->first(['email' => $_POST['email']]);

                                // Insert into validator table
                                $validatorData = [
                                    'user_id'   => $newUser->user_id,
                                    'firstName' => $_POST['firstName'],
                                    'lastName'  => $_POST['lastName'],
                                    'contactNo' => $_POST['contactNo'],
                                    'validator_photo_path'  => $photo_target,
                                ];
                                $validator->insert($validatorData);

                                redirect('login');
                                exit;
                            } else {
                                $user->errors['validator_photo_path'] = "Failed to upload profile picture";
                            }
                        break;

                    case 'company':
                        $company = new Company;

                        //Check if email already exists
                        $email_existing = $user->first(['email' => $_POST['email']]);
                        if ($email_existing) {
                            $user->errors['email'] = "Email already exists";
                        }
                        else if($_POST['confirm_password'] !== $_POST['password']){
                            $user->errors['confirm_password'] = "passwords do not match";
                        }
                        else {
                            // Handle business registration certificate upload
                            if (isset($_FILES['business_certificate']) && $_FILES['business_certificate']['error'] === UPLOAD_ERR_OK) {
                                $upload_path = $_SERVER['DOCUMENT_ROOT'] . '/CareerSync/MVC/public/assets/uploads/certificates/';
                                $filename = time() . '_' . basename($_FILES['business_certificate']['name']); // unique file name
                                $target_file = $upload_path . $filename;

                                // Create directory if not exists
                                if (!is_dir($upload_path)) {
                                    mkdir($upload_path, 0777, true);
                                }

                                // Validate file extension
                                $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
                                $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                                if (in_array($fileExt, $allowedExtensions)) {
                                    if (move_uploaded_file($_FILES['business_certificate']['tmp_name'], $target_file)) {
                                        // Store relative path in DB for later use
                                        $certificatePath = 'assets/uploads/certificates/' . $filename;
                                    }else{
                                        $user->errors['business_certificate'] = "Error uploading the business registration certificate.";
                                    }
                                }else{
                                    $user->errors['business_certificate'] = "Invalid file type. Allowed types: PDF, JPG, JPEG, PNG.";
                                }
                            } else {
                                $user->errors['business_certificate'] = "Please upload a business registration certificate.";
                            }

                            // Proceed only if there are no errors
                            if (empty($user->errors)) {
                                // Insert into users table first
                                $user->insert($userTableData);
                                $newUser = $user->first(['email' => $_POST['email']]);

                                // Prepare company table data
                                $companyData = [
                                    'user_id'              => $newUser->user_id,
                                    'companyName'          => $_POST['companyName'],
                                    'contactNo'            => $_POST['contactNo'],
                                    'hr_firstName'         => $_POST['hr_firstName'],
                                    'hr_lastName'          => $_POST['hr_lastName'],
                                    'hr_email'             => $_POST['hr_email'],
                                    'hr_contactNo'         => $_POST['hr_contactNo'],
                                    'business_certificate' => $certificatePath,
                                ];
                                $company->insert($companyData);

                                redirect('login');
                                exit;
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
                                        'user_id'               => $newUser->user_id,
                                        'firstName'             => $_POST['firstName'],
                                        'lastName'              => $_POST['lastName'],
                                        'contactNo'             => $_POST['contactNo'],
                                        'counselor_photo_path'  => $photo_target,
                                        'certificate_path'      => $certificate_target,
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
