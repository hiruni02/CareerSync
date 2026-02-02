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

        $isPasswordChange = ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'password_change');
        $isProfileUpdate  = ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'profile_change');

        switch ($_SESSION['USER']->role) {
            case 'admin':
                include("dashboard_controllers/adminDash_controller.php");
                break;
            case 'candidate':
                include("dashboard_controllers/candidateDash_controller.php");
                break;

            case 'company':
                include("dashboard_controllers/companyDash_controller.php");
                break;

            case 'validator':
                include("dashboard_controllers/validatorDash_controller.php");
                break;

            case 'counselor':
                include("dashboard_controllers/counselorDash_controller.php");
                break;
        }
        if ($isPasswordChange) {
            $pw_errors = [];

            if (!password_verify($_POST['oldPassword'], $data['userTable']->password)) {
                $pw_errors['oldPassword'] = "Incorrect Password";
            } else if ($_POST['newPassword'] !== $_POST['confirm_new_password']) {
                $pw_errors['confirm_new_password'] = "Passwords do not match";
            }

            if (empty($pw_errors)) {
                // Prepare user update array
                if (!empty($_POST['newPassword'])) {
                    $userUpdate['password'] = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                }
                $user->update($_SESSION['USER']->user_id, $userUpdate, 'user_id');

                $updatedUser = $user->first(['user_id' => $_SESSION['USER']->user_id]);
                if ($updatedUser) {
                    $_SESSION['USER'] = $updatedUser;
                }
                $_SESSION['USER']->firstName = $_POST['firstName']; //this is to fix an error in the home page. do this, or log out once edited profile
                switch ($_SESSION['USER']->role) {
                    case 'admin':
                        $_SESSION['USER']->photo_path = $photoPath ?? $data['adminTable']->admin_photo_path;
                        break;
                    case 'company':
                        $_SESSION['USER']->photo_path = $photoPath ?? $data['companyTable']->company_photo_path;
                        break;
                    case 'counselor':
                        $_SESSION['USER']->photo_path = $photoPath ?? $data['counselorTable']->counselor_photo_path;
                        break;
                    case 'validator':
                        $_SESSION['USER']->photo_path = $photoPath ?? $data['validatorTable']->validator_photo_path;
                        break;
                    case 'candidate':
                        $_SESSION['USER']->photo_path = $photoPath ?? $data['candidateTable']->candidate_photo_path;
                        break;
                }
                SystemLogger::log('CHANGED_PASSWORD','ID: '.$_SESSION['USER']->user_id.' changed account password');
                //unset($_SESSION['USER']);//this loggs out after editing profile
                redirect('dashboard');
                exit;
            }

            $data['errors'] = $pw_errors;
        }

        $this->view("dashboard", $data);  // loads dashboard.view.php
    }
}
