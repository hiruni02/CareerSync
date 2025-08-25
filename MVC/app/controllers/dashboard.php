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
                $candidate = new Candidate;
                $data['candidateTable'] = $candidate->first(['user_id' => $_SESSION['USER']->user_id]);

                // Handle profile update
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProfile'])) {
                    $updateData = [
                        'first_name' => $_POST['first_name'] ?? '',
                        'last_name'  => $_POST['last_name'] ?? '',
                        'phone'      => $_POST['phone'] ?? '',
                        'email'      => $_POST['email'] ?? '',
                     ];

                    // Profile picture upload
                    if (!empty($_FILES['profile_pic']['name'])) {
                        $fileName   = time() . "_" . basename($_FILES['profile_pic']['name']);
                        $targetPath = "uploads/candidate_photos/" . $fileName;

                        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetPath)) {
                            $updateData['profile_pic'] = $fileName;
                        }
                    }

                    $candidate->update($data['candidateTable']->candidate_id, $updateData);

                    // Refresh data
                    $data['candidateTable'] = $candidate->first(['user_id' => $_SESSION['USER']->user_id]);

                    // Redirect to avoid resubmission
                    header("Location: " . ROOT . "dashboard");
                    exit;
                }
                break;


            case 'company':
                //extract company data
                break;
            case 'validator':
                //extract validator data
                break;
            case 'counselor':
                //extract counselor data
                break;
        }

        $this->view("dashboard", $data);  // loads dashboard.view.php
    }
}
