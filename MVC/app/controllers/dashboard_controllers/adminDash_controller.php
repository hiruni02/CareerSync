<?php
//extract admin data
$admin = new Admin;
$data['adminTable'] = $admin->first(['user_id' => $_SESSION['USER']->user_id]);
$data['validators'] = $admin->getValidatorDetails();

$reports = new AdminReportDetails;
$data['oldReportDetails'] = $reports->selectOldReports();

$photoPath = null;

//code for updating user profile 
if ($isProfileUpdate) {
    $errors = [];

    if ($data['userTable']->password !== $_POST['confirm_password']) {
        $errors['confirm_password'] = "Incorrect password";
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
        redirect('dashboard');
        exit;
    }

    $data['errors'] = $errors;
}

$isManageValidator = ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'validateValidator');

if ($isManageValidator) {
    $validatorId = $_POST['validator_id'] ?? null;
    if (!$validatorId) {
        redirect('dashboard');
        exit;
    }

    $user = new User;
    $validator = new Validator;

    if (isset($_POST['grant'])) {
        $user->update(
            $validatorId,
            ['status' => 'active'],
            'user_id'
        );
    }

    if (isset($_POST['deny'])) {
        $validator->delete($validatorId, 'user_id');
        $user->delete($validatorId, 'user_id');
    }
    redirect('dashboard');
    exit;
}
