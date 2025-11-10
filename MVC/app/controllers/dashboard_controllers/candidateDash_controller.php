<?php
//extract candidate data
$candidate = new Candidate;
$data['candidateTable'] = $candidate->first(['user_id' => $_SESSION['USER']->user_id]);

//extract the CV's sent by the candidate
$cv = new CV;
$data['cv'] = $cv->getSentCVsByCandidate($_SESSION['USER']->user_id);

//extracting interview details
$interview = new Interview;
$data['interview'] = $interview->getCandidateInterview($_SESSION['USER']->user_id);

$photoPath = null;

//code for updating user profile 
if ($isProfileUpdate) {
    $errors = [];

    if ($data['userTable']->password !== $_POST['confirm_password']) {
        $errors['confirm_password'] = "Incorrect password";
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
