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

$confirmedInterview = new Interview;
$data['confirmedInterview'] = $confirmedInterview->getInterviewsByCandidate($_SESSION['USER']->user_id);

//for the counselor selector
$counselors = new Counselor;
$data['counselors'] = $counselors->SelectAll();

$consultation = new Consultation;
$data['consultation'] = $consultation->getConsultationDetails($_SESSION['USER']->user_id);

$data['consultationMeeting'] = $consultation->getCandidateConsultation($_SESSION['USER']->user_id);

$isConfirmingInterviewDate = ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'candidate_scheduler');
$requestMeetingWithCounselor = ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'send_meeting_request');
$isConfirmingConsultationDate = ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'candidate_consultation_scheduler');


//code for updating user profile 
$photoPath = null;
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
        $_SESSION['USER']->firstName = $_POST['firstName'];
        $_SESSION['USER']->photo_path = $photoPath ?? $data['candidateTable']->candidate_photo_path;
        redirect('home');
        exit;
    }

    $data['errors'] = $errors;
}

if ($isConfirmingInterviewDate) {
    $interview_id = $_POST['interview_id'];
    $selected_date = $_POST['selected_date'];

    $interview = new Interview;
    $slot = new InterviewSlot;

    // fetch interview record
    $interviewRecord = $interview->first([
        'candidate_id' => $_SESSION['USER']->user_id,
        'interview_id' => $interview_id
    ]);

    if ($interviewRecord) {
        $interview->update(
            $interviewRecord->interview_id,
            ['dateConfirmed' => 'confirmed'],
            'interview_id'
        );

        $allSlots = $slot->where(['interview_id' => $interview_id]);

        if (!empty($allSlots)) {
            foreach ($allSlots as $s) {
                if ($s->slot_datetime !== $selected_date) {
                    $slot->delete($s->slot_id, 'slot_id');
                }
            }
        }
        redirect('dashboard');
        exit;
    }
}

if ($requestMeetingWithCounselor) {
    $counselorRequest = new ConsultationRequest;
    $newRequest = [
        'counselor_id' => $_POST['counselor_id'],
        'candidate_id' => $_SESSION['USER']->user_id,
    ];

    $existing = $counselorRequest->first([
        'counselor_id' => $_POST['counselor_id'],
        'candidate_id' => $_SESSION['USER']->user_id,
    ]);

    if (!$existing) {
        $counselorRequest->insert($newRequest);
    }

    redirect('dashboard');
    exit;
}

if ($isConfirmingConsultationDate) {

    $meeting_id = $_POST['meeting_id'];
    $selected_date = $_POST['selected_date'];

    $consultation = new Consultation;
    $slot = new ConsultationSlot;

    // Verify meeting exists
    $meetingRecord = $consultation->first([
        'candidate_id' => $_SESSION['USER']->user_id,
        'meeting_id' => $meeting_id
    ]);

    if ($meetingRecord) {

        // Mark consultation date as confirmed
        $consultation->update(
            $meeting_id,
            ['dateConfirmed' => 'confirmed'],
            'meeting_id'
        );

        // Remove all other slots
        $allSlots = $slot->where(['meeting_id' => $meeting_id]);

        if (!empty($allSlots)) {
            foreach ($allSlots as $s) {
                if ($s->slot_datetime !== $selected_date) {
                    $slot->delete($s->slot_id, 'slot_id');
                }
            }
        }
        redirect('dashboard');
        exit;
    }
}
