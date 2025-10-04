<?php
// Extract company data
$company = new Company;
$data['companyTable'] = $company->first(['user_id' => $_SESSION['USER']->user_id]);

$photoPath = null;
$certificatePath = $data['companyTable']->business_certificate ?? null;

if ($isProfileUpdate) {
    $errors = [];

    // Password check
    if ($data['userTable']->password !== $_POST['confirm_password']) {
        $errors['confirm_password'] = "Incorrect password";
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
if ($isPostingJob) {
    $jobPost = new JobPost;
    $jobData = [
        'company_id'       => $_SESSION['USER']->user_id,
        'posTitle'          => $_POST['posTitle'],
        'posType'          => $_POST['posType'],
        'industry'          => $_POST['industry'],
        'exp_level'         => $_POST['exp_level'],
        'yearsOfExp'        => $_POST['yearsOfExp'],
        'qualifications'    => $_POST['qualifications'] ?? '',
        'required_skills'   => $_POST['required_skills'] ?? '',
        'salaryDetails'     => $_POST['salaryDetails'],
        'address'           => $_POST['address'],
        'city'              => $_POST['city'],
        'workMode'          => $_POST['workMode'],
        'jobDescription'    => $_POST['jobDescription'],
        'vacancies'         => $_POST['vacancies'],
        'deadline'          => $_POST['deadline'],
    ];
    $jobPost->insert($jobData);
    unset($_POST);
}
