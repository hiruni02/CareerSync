<?php
class Dashboard
{
    use Controller;

    public function index()
    {
        $data['email'] = !empty($_SESSION['USER']) ? $_SESSION['USER']->email : null;

        //with this method we could extract data from the user id across all tables
        $user = new User;
        $data['userTable'] = $user->first(['user_id' => $_SESSION['USER']->user_id]);
        switch ($_SESSION['USER']->role) {
            case 'admin':
                //extract admin data
                $admin = new Admin;
                $data['adminTable'] = $admin->first(['user_id' => $_SESSION['USER']->user_id]);

                $photoPath = null;

                //code for updating user profile 
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $errors = [];

                    if ($_POST['password'] !== $_POST['confirm_password']) {
                        $errors['confirm_password'] = "Passwords do not match";
                    }

                    if (!empty($_FILES['admin_photo_path']['name'])) {
                        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/CareerSync/MVC/public/assets/uploads/admin_photo/';

                        $filename = time() . '_' . basename($_FILES['admin_photo_path']['name']);
                        $target = $uploadDir . $filename;

                        $allowed = ['jpg', 'jpeg', 'png'];
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        if (!in_array($ext, $allowed)) {
                            $errors['admin_photo_path'] = "Invalid file type. Only JPG, JPEG, PNG allowed.";
                        } elseif (move_uploaded_file($_FILES['admin_photo_path']['tmp_name'], $target)) {
                            $photoPath = 'assets/uploads/admin_photo/' . $filename;
                        } else {
                            $errors['admin_photo_path'] = "Error uploading photo.";
                        }
                    }

                    if (empty($errors)) {
                        // Prepare user update array
                        $userUpdate = ['email' => $_POST['email']];
                        if (!empty($_POST['password'])) {
                            $userUpdate['password'] = $_POST['password'];
                        }
                        $user->update($_SESSION['USER']->user_id, $userUpdate, 'user_id');

                        // Prepare admin update array
                        $adminUpdate = [
                            'firstName' => $_POST['firstName'] ?? '',
                            'lastName' => $_POST['lastName'] ?? '',
                            'contactNo' => $_POST['contactNo'] ?? '',
                            'admin_photo_path' => $photoPath ?? $data['adminTable']->admin_photo_path
                        ];

                        $admin->update($_SESSION['USER']->user_id, $adminUpdate, 'user_id');

                        $updatedUser = $user->first(['user_id' => $_SESSION['USER']->user_id]);
                        if ($updatedUser) {
                            $_SESSION['USER'] = $updatedUser;
                        }
                        $_SESSION['USER']->firstName = $_POST['firstName']; //this is to fix an error in the home page. do this, or log out once edited profile
                        $_SESSION['USER']->photo_path = $photoPath ?? $data['adminTable']->admin_photo_path; //need to fix this too. editing pfp and redirecting to a logged in home doesnt show the pfp
                        //unset($_SESSION['USER']);//this loggs out after editing profile
                        redirect('home');
                        exit;
                    }

                    $data['errors'] = $errors;
                }

                break;
            case 'candidate':
                //extract candidate data
                $candidate = new Candidate;
                $data['candidateTable'] = $candidate->first(['user_id' => $_SESSION['USER']->user_id]);

                $photoPath = null;

                //code for updating user profile 
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $errors = [];

                    if ($_POST['password'] !== $_POST['confirm_password']) {
                        $errors['confirm_password'] = "Passwords do not match";
                    }

                    if (!empty($_FILES['candidate_photo_path']['name'])) {
                        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/CareerSync/MVC/public/assets/uploads/candidate_photos/';

                        $filename = time() . '_' . basename($_FILES['candidate_photo_path']['name']);
                        $target = $uploadDir . $filename;

                        $allowed = ['jpg', 'jpeg', 'png'];
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        if (!in_array($ext, $allowed)) {
                            $errors['candidate_photo_path'] = "Invalid file type. Only JPG, JPEG, PNG allowed.";
                        } elseif (move_uploaded_file($_FILES['candidate_photo_path']['tmp_name'], $target)) {
                            $photoPath = 'assets/uploads/candidate_photos/' . $filename;
                            $_SESSION['USER']->photo_path = $photoPath;
                        } else {
                            $errors['candidate_photo_path'] = "Error uploading photo.";
                        }
                    }

                    if (empty($errors)) {
                        // Prepare user update array
                        $userUpdate = ['email' => $_POST['email']];
                        if (!empty($_POST['password'])) {
                            $userUpdate['password'] = $_POST['password'];
                        }
                        $user->update($_SESSION['USER']->user_id, $userUpdate, 'user_id');

                        // Prepare candidate update array
                        $candidateUpdate = [
                            'firstName' => $_POST['firstName'] ?? '',
                            'lastName' => $_POST['lastName'] ?? '',
                            'contactNo' => $_POST['contactNo'] ?? '',
                            'candidate_photo_path' => $photoPath ?? $data['candidateTable']->candidate_photo_path
                        ];

                        $candidate->update($_SESSION['USER']->user_id, $candidateUpdate, 'user_id');

                        $updatedUser = $user->first(['user_id' => $_SESSION['USER']->user_id]);
                        if ($updatedUser) {
                            $_SESSION['USER'] = $updatedUser;
                        }
                        $_SESSION['USER']->firstName = $_POST['firstName']; //this is to fix an error in the home page. do this, or log out once edited profile
                        $_SESSION['USER']->photo_path = $photoPath ?? $data['candidateTable']->candidate_photo_path; //need to fix this too. editing pfp and redirecting to a logged in home doesnt show the pfp
                        //unset($_SESSION['USER']);//this loggs out after editing profile
                        redirect('home');
                        exit;
                    }

                    $data['errors'] = $errors;
                }
                break;

            case 'company':
                // Extract company data
                $company = new Company;
                $data['companyTable'] = $company->first(['user_id' => $_SESSION['USER']->user_id]);

                $photoPath = null;
                $certificatePath = $data['companyTable']->business_certificate ?? null;

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $errors = [];

                    // Password check
                    if ($_POST['password'] !== $_POST['confirm_password']) {
                        $errors['confirm_password'] = "Passwords do not match";
                    }

                    // Handle company logo upload
                    if (!empty($_FILES['company_photo_path']['name'])) {
                        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/CareerSync/MVC/public/assets/uploads/company_logos/';
                        $filename = time() . '_' . basename($_FILES['company_photo_path']['name']);
                        $target = $uploadDir . $filename;

                        $allowed = ['jpg', 'jpeg', 'png'];
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        if (!in_array($ext, $allowed)) {
                            $errors['company_photo_path'] = "Invalid file type. Only JPG, JPEG, PNG allowed.";
                        } elseif (move_uploaded_file($_FILES['company_photo_path']['tmp_name'], $target)) {
                            $photoPath = 'assets/uploads/company_logos/' . $filename; 
                            $_SESSION['USER']->photo_path = $photoPath;
                        } else {
                            $errors['company_photo_path'] = "Error uploading logo.";
                        }
                    }

                    // Handle business certificate upload
                    if (!empty($_FILES['business_certificate']['name'])) {
                        $certDir = $_SERVER['DOCUMENT_ROOT'] . '/CareerSync/MVC/public/assets/uploads/business_certificates/';
                        $certFilename = time() . '_' . basename($_FILES['business_certificate']['name']);
                        $certTarget = $certDir . $certFilename;

                        $allowed = ['jpg', 'jpeg', 'png'];
                        $ext = strtolower(pathinfo($certFilename, PATHINFO_EXTENSION));
                        if (!in_array($ext, $allowed)) {
                            $errors['business_certificate'] = "Invalid file type. Only JPG, JPEG, PNG allowed.";
                        } elseif (move_uploaded_file($_FILES['business_certificate']['tmp_name'], $certTarget)) {
                            $certificatePath = 'assets/uploads/business_certificates/' . $certFilename; 
                        } else {
                            $errors['business_certificate'] = "Error uploading certificate.";
                        }
                    }

                    if (empty($errors)) {
                        // Update user table
                        $userUpdate = ['email' => $_POST['email']];
                        if (!empty($_POST['password'])) {
                            $userUpdate['password'] = $_POST['password'];
                        }
                        $user->update($_SESSION['USER']->user_id, $userUpdate, 'user_id');

                        // Update company table
                        $companyUpdate = [
                            'companyName'          => $_POST['companyName'] ?? '',
                            'contactNo'            => $_POST['contactNo'] ?? '',
                            'hr_firstName'         => $_POST['hr_firstName'] ?? '',
                            'hr_lastName'          => $_POST['hr_lastName'] ?? '',
                            'hr_contactNo'         => $_POST['hr_contactNo'] ?? '',
                            'hr_email'             => $_POST['hr_email'] ?? '',
                            'company_photo_path'   => $photoPath ?? $data['companyTable']->company_photo_path,
                            'business_certificate' => $certificatePath
                        ];

                        $company->update($_SESSION['USER']->user_id, $companyUpdate, 'user_id');

                        // Refresh session
                        $updatedUser = $user->first(['user_id' => $_SESSION['USER']->user_id]);
                        if ($updatedUser) {
                            $_SESSION['USER'] = $updatedUser;
                        }

                        // set name & photo for header use
                        $_SESSION['USER']->hr_firstName = $_POST['hr_firstName'];
                        $_SESSION['USER']->photo_path = $photoPath ?? $data['companyTable']->company_photo_path;

                        redirect('home');
                        exit;
                    }

                    $data['errors'] = $errors;
                }
                break;


            case 'validator':
                //extract validator data
                $validator = new Validator;
                $data['validatorTable'] = $validator->first(['user_id' => $_SESSION['USER']->user_id]);

                $photoPath = null;

                //code for updating user profile 
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $errors = [];

                    if ($_POST['password'] !== $_POST['confirm_password']) {
                        $errors['confirm_password'] = "Passwords do not match";
                    }

                    if (!empty($_FILES['validator_photo_path']['name'])) {
                        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/CareerSync/MVC/public/assets/uploads/validator_photos/';

                        $filename = time() . '_' . basename($_FILES['validator_photo_path']['name']);
                        $target = $uploadDir . $filename;

                        $allowed = ['jpg', 'jpeg', 'png'];
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        if (!in_array($ext, $allowed)) {
                            $errors['validator_photo_path'] = "Invalid file type. Only JPG, JPEG, PNG allowed.";
                        } elseif (move_uploaded_file($_FILES['validator_photo_path']['tmp_name'], $target)) {
                            $photoPath = 'assets/uploads/validator_photos/' . $filename;
                            $_SESSION['USER']->photo_path = $photoPath;
                        } else {
                            $errors['validator_photo_path'] = "Error uploading photo.";
                        }
                    }

                    if (empty($errors)) {
                        // Prepare user update array
                        $userUpdate = ['email' => $_POST['email']];
                        if (!empty($_POST['password'])) {
                            $userUpdate['password'] = $_POST['password'];
                        }
                        $user->update($_SESSION['USER']->user_id, $userUpdate, 'user_id');

                        // Prepare validator update array
                        $validatorUpdate = [
                            'firstName' => $_POST['firstName'] ?? '',
                            'lastName' => $_POST['lastName'] ?? '',
                            'contactNo' => $_POST['contactNo'] ?? '',
                            'validator_photo_path' => $photoPath ?? $data['validatorTable']->validator_photo_path
                        ];

                        $validator->update($_SESSION['USER']->user_id, $validatorUpdate, 'user_id');

                        $updatedUser = $user->first(['user_id' => $_SESSION['USER']->user_id]);
                        if ($updatedUser) {
                            $_SESSION['USER'] = $updatedUser;
                        }
                        $_SESSION['USER']->firstName = $_POST['firstName']; //this is to fix an error in the home page. do this, or log out once edited profile
                        $_SESSION['USER']->photo_path = $photoPath ?? $data['validatorTable']->validator_photo_path; //need to fix this too. editing pfp and redirecting to a logged in home doesnt show the pfp
                        //unset($_SESSION['USER']);//this loggs out after editing profile
                        redirect('home');
                        exit;
                    }

                    $data['errors'] = $errors;
                }
                break;

            case 'counselor':
                //extract counselor data
                $counselor = new Counselor;
                $data['counselorTable'] = $counselor->first(['user_id' => $_SESSION['USER']->user_id]);

                $photoPath = null;

                //code for updating user profile 
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $errors = [];

                    if ($_POST['password'] !== $_POST['confirm_password']) {
                        $errors['confirm_password'] = "Passwords do not match";
                    }

                    if (!empty($_FILES['counselor_photo_path']['name'])) {
                        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/CareerSync/MVC/public/assets/uploads/counselor_photos/';

                        $filename = time() . '_' . basename($_FILES['counselor_photo_path']['name']);
                        $target = $uploadDir . $filename;

                        $allowed = ['jpg', 'jpeg', 'png'];
                        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        if (!in_array($ext, $allowed)) {
                            $errors['counselor_photo_path'] = "Invalid file type. Only JPG, JPEG, PNG allowed.";
                        } elseif (move_uploaded_file($_FILES['counselor_photo_path']['tmp_name'], $target)) {
                            $photoPath = 'assets/uploads/counselor_photos/' . $filename;
                            $_SESSION['USER']->photo_path = $photoPath;
                        } else {
                            $errors['counselor_photo_path'] = "Error uploading photo.";
                        }
                    }

                    if (empty($errors)) {
                        // Prepare user update array
                        $userUpdate = ['email' => $_POST['email']];
                        if (!empty($_POST['password'])) {
                            $userUpdate['password'] = $_POST['password'];
                        }
                        $user->update($_SESSION['USER']->user_id, $userUpdate, 'user_id');

                        // Prepare counselor update array
                        $counselorUpdate = [
                            'firstName' => $_POST['firstName'] ?? '',
                            'lastName' => $_POST['lastName'] ?? '',
                            'contactNo' => $_POST['contactNo'] ?? '',
                            'counselor_photo_path' => $photoPath ?? $data['counselorTable']->counselor_photo_path
                        ];

                        $counselor->update($_SESSION['USER']->user_id, $counselorUpdate, 'user_id');

                        $updatedUser = $user->first(['user_id' => $_SESSION['USER']->user_id]);
                        if ($updatedUser) {
                            $_SESSION['USER'] = $updatedUser;
                        }
                        $_SESSION['USER']->firstName = $_POST['firstName']; //this is to fix an error in the home page. do this, or log out once edited profile
                        $_SESSION['USER']->photo_path = $photoPath ?? $data['counselorTable']->counselor_photo_path; //need to fix this too. editing pfp and redirecting to a logged in home doesnt show the pfp
                        //unset($_SESSION['USER']);//this loggs out after editing profile
                        redirect('home');
                        exit;
                    }

                    $data['errors'] = $errors;
                }
                break;
        }

        $this->view("dashboard", $data);  // loads dashboard.view.php
    }
}
