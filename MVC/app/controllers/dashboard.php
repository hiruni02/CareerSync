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
                        $_SESSION['USER']->photo_path = $photoPath;//need to fix this too. editing pfp and redirecting to a logged in home doesnt show the pfp
                        //unset($_SESSION['USER']);//this loggs out after editing profile
                        redirect('home');
                        exit;
                    }

                    $data['errors'] = $errors;
                }

                break;
            case 'candidate':
                //extract candidate data
                break;
            case 'company':
                //extract company data
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
                        $_SESSION['USER']->photo_path = $photoPath;//need to fix this too. editing pfp and redirecting to a logged in home doesnt show the pfp
                        //unset($_SESSION['USER']);//this loggs out after editing profile
                        redirect('home');
                        exit;
                    }

                    $data['errors'] = $errors;
                }

                break;
            case 'counselor':
                //extract counselor data
                break;
        }

        $this->view("dashboard", $data);  // loads dashboard.view.php
    }
}
