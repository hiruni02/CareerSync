<?php
class register
{
    use Controller;

    public function index()
    {
        $user = new User;
        $data = [];

        // if not logged in, the $username variable is defaulted to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Add role to POST
            $role = $_GET['role'] ?? null;
            if ($role) {
                $_POST['role'] = $role;
            }

            // Check if email already exists
            $email_existing = $user->first(['email' => $_POST['email']]);
            if ($email_existing) {
                $user->errors['email'] = "Email already exists";
            } else if ($_POST['confirm_password'] !== $_POST['password']) {
                $user->errors['confirm_password'] = "passwords do not match";
            } else {
                $userTableData = $_POST;

                // updating table fields based on role
                switch ($role) {
                    case 'validator':
                        $validator = new validator;

                        $nic_existing = $validator->first(['nic_no' => $_POST['nic_no']]);
                        if ($nic_existing) {
                            $user->errors['nic_no'] = "NIC number already exists";
                        } else {
                            $upload_path = $_SERVER['DOCUMENT_ROOT'] . '/CareerSync/MVC/public/assets/uploads/validator_ids/';
                            $filename = time() . '_' . basename($_FILES['nic_path']['name']); // makes each upload file name unique
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

                    case 'company':
                        $company = new Company;

                        // Check if company email already exists
                        $company_existing = $company->first(['email' => $_POST['email']]);
                        if ($company_existing) {
                            $user->errors['email'] = "Company email already exists";
                        } else {
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
                                    } else {
                                        $user->errors['business_certificate'] = "Error uploading the business registration certificate.";
                                    }
                                } else {
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
                                    'email'                => $_POST['email'],
                                    'contactNo'            => $_POST['contactNo'],
                                    'hr_name'              => $_POST['hr_name'],
                                    'hr_email'             => $_POST['hr_email'],
                                    'hr_contact'           => $_POST['hr_contact'],
                                    'business_certificate' => $certificatePath,
                                    'password'             => $_POST['password']  // stored as-is, no hashing
                                ];
                                $insertResult = $company->insert($companyData);

                                

                                $company->insert($companyData);

                                redirect('login');
                                exit;
                            }
                        }
                        break;


                        /*
                    case 'conunselor':
                    break;

                    case 'candidate':
                    break;
                    */
                }
            }

            // Send errors to the view
            $data['errors'] = $user->errors;
        }

        $this->view("register", $data);
    }
}
