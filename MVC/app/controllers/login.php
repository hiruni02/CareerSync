<?php
class login
{
    use Controller;
    public function index()
    {
        $user = new User;
        $data = [];

        //if not logged in the $username variable is deafulted to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->firstName;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $row = $user->first(['email' => $_POST['email']]);
            if ($row) {
                if (/*$row->password === $_POST['password']*/password_verify($_POST["password"],$row->password)) {
                    $_SESSION['USER'] = $row;
                    switch ($row->role) {
                        case 'admin':
                            $admin = new Admin();
                            $extra = $admin->first(['user_id' => $row->user_id]);
                            $_SESSION['USER']->photo_path = $extra->admin_photo_path;
                            break;
                        case 'candidate':
                            $candidate = new Candidate();
                            $extra = $candidate->first(['user_id' => $row->user_id]);
                            $_SESSION['USER']->photo_path = $extra->candidate_photo_path;
                            break;
                        case 'counselor':
                            $counselor = new Counselor();
                            $extra = $counselor->first(['user_id' => $row->user_id]);
                            $_SESSION['USER']->photo_path = $extra->counselor_photo_path;
                            break;
                        case 'validator':
                            $validator = new Validator();
                            $extra = $validator->first(['user_id' => $row->user_id]);
                            $_SESSION['USER']->photo_path = $extra->validator_photo_path;
                            break;
                        case 'company':
                            $company = new Company();
                            $extra = $company->first(['user_id' => $row->user_id]);
                            $_SESSION['USER']->photo_path = $extra->company_photo_path;
                            break;
                        default:
                            $extra = null;
                    }

                    if ($extra && isset($extra->firstName)) {
                        $_SESSION['USER']->firstName = $extra->firstName;
                        $_SESSION['USER']->user_id = $row->user_id;
                        $_SESSION['USER']->role = $row->role;
                    }
                    if ($row->role == 'company') {
                        $_SESSION['USER']->hr_firstName = $extra->hr_firstName;
                    }
                    SystemLogger::log('LOGIN_SUCCESS', 'User logged in');
                    redirect('home');
                    exit;
                } else {
                    $user->errors['password'] = "Incorrect password";
                    SystemLogger::log('LOGIN_FAILED', 'Invalid credentials');
                }
            } else {
                $user->errors['email'] = "Email doesnt exist";
            }
            //Send errors to the view
            $data['errors'] = $user->errors;
        }


        $this->view("login", $data);
    }
}
