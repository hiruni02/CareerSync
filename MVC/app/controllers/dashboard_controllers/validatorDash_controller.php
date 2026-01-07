<?php
//extract validator data
$validator = new Validator;
$data['validatorTable'] = $validator->first(['user_id' => $_SESSION['USER']->user_id]);

$photoPath = null;

//code for updating user profile 
if ($isProfileUpdate) {
    $errors = [];

    if ($data['userTable']->password !== $_POST['confirm_password']) {
        $errors['confirm_password'] = "Incorrect password";
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

$cv = new CV;

require_once 'C:/xampp/htdocs/CareerSync/MVC/app/models/jobPost.php';
require_once 'C:/xampp/htdocs/CareerSync/MVC/app/models/candidate.php';
require_once 'C:/xampp/htdocs/CareerSync/MVC/app/models/message.php';

$data['applications'] = $cv->SelectAll();

$is_Validating_CV  = ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'validateCV');
if ($is_Validating_CV) {
    if ($data['approval']->validator_approval === 'pending') {
    }
    $cv_id = $_POST['cv_id'] ?? null;

    if (isset($_POST['approve'])) {
        $status = 'approved';
    } elseif (isset($_POST['reject'])) {
        $status = 'rejected';
    } else {
        $status = null;
    }

    if ($cv_id && $status) {
        $cv->update($cv_id, ['validator_approval' => $status], 'cv_id');
        
        if ($status === 'approved') {
            // Get CV data
            $cvData = $cv->first(['cv_id' => $cv_id]);
            $job_id = $cvData->job_id;
            
            // Get job data to find company_id
            $jobPost = new JobPost();
            $jobData = $jobPost->first(['job_id' => $job_id]);
            $company_id = $jobData->company_id;
            
            // Get candidate name
            $candidateModel = new Candidate();
            $candidateData = $candidateModel->first(['user_id' => $cvData->candidate_id]);
            $candidateName = $candidateData->firstName . ' ' . $candidateData->lastName;
            
            // Insert notification message to company
            $messageModel = new Message();
            $messageModel->insert([
                'receiver_id' => $company_id,
                'receiver_type' => 'company',
                'content' => "A candidate, {$candidateName}, has applied to your job '{$jobData->posTitle}' and has been validated.",
                'is_read' => 0
            ]);
        } else if ($status === 'rejected') {
            // Get CV data
            $cvData = $cv->first(['cv_id' => $cv_id]);
            $candidate_id = $cvData->candidate_id;
            
            // Insert notification message to candidate
            $messageModel = new Message();
            $messageModel->insert([
                'receiver_id' => $candidate_id,
                'receiver_type' => 'candidate',
                'content' => "Your CV has been rejected. Please ensure it contains accurate and proper information.",
                'is_read' => 0
            ]);
        }
        
        redirect('dashboard');
    }
}
