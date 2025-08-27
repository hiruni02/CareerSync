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
                break;
            case 'candidate':
                //extract candidate data
                break;
            case 'company':
                //extract company data
                break;
            case 'validator':
                //extract validator data
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
                        $_SESSION['USER']->firstName = $_POST['firstName']; // fix error in homepage
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
