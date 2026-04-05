<?php
//extract admin data
$admin = new Admin;
$data['totalUsers'] = $admin->getTotalUsers();
$data['activeUsers'] = $admin->getActiveUsersLast7Days();
$data['systemAlertCount'] = $admin->getSystemAlertCount();
$data['totalJobPosts'] = $admin->getTotalJobPosts();
$data['adminTable'] = $admin->first(['user_id' => $_SESSION['USER']->user_id]);
$data['validators'] = $admin->getValidatorDetails();
$data['candidates'] = $admin->getCandidateDetails();
$data['counselors'] = $admin->getCounselorDetails();
$data['companies'] = $admin->getCompanyDetails();
$data['sysAlerts'] = $admin->getSysAlerts();

$feedbackModel = new ContactModel();
$data['feedbacks'] = $feedbackModel->SelectAll();
$reports = new AdminReportDetails;
$reports->generateMonthlyReportIfMissing($_SESSION['USER']->user_id);
$data['oldReportDetails'] = $reports->selectOldReports();

require_once __DIR__ . '/../../models/ContactModel.php';

$model = new ContactModel();

// 2️⃣ Handle delete
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    $deleted = $model->deleteMessage($id); // now $model is not null
    header("Location: " . $_SERVER['PHP_SELF']); // reload page
    exit;
}


$photoPath = null;

//code for updating user profile 
if ($isProfileUpdate) {
    $errors = [];

    if (!password_verify($_POST['confirm_password'], $data['userTable']->password)) {
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
$isManageCounselor = ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'validateCounselor');
$isManageCompany = ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'validateCompany');

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

if ($isManageCounselor) {
    $counselorId = $_POST['counselor_id'] ?? null;
    if (!$counselorId) {
        redirect('dashboard');
        exit;
    }

    $user = new User;
    $counselor = new Counselor;

    if (isset($_POST['grant'])) {
        $user->update(
            $counselorId,
            ['status' => 'active'],
            'user_id'
        );
    }

    if (isset($_POST['deny'])) {
        $counselor->delete($counselorId, 'user_id');
        $user->delete($counselorId, 'user_id');
    }
    redirect('dashboard');
    exit;
}

if ($isManageCompany) {
    $companyId = $_POST['company_id'] ?? null;
    if (!$companyId) {
        redirect('dashboard');
        exit;
    }

    $user = new User;
    $company = new Company;

    if (isset($_POST['grant'])) {
        $user->update(
            $companyId,
            ['status' => 'active'],
            'user_id'
        );
    }

    if (isset($_POST['deny'])) {
        $company->delete($companyId, 'user_id');
        $user->delete($companyId, 'user_id');
    }
    redirect('dashboard');
    exit;
}