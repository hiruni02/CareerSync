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
                if ($row->password === $_POST['password']) {
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
                            //NEED TO ADD COMPANY LOGO TO SESSION AFTER COMPANY LOGO IS IMPLEMENTED
                            break;
                        default:
                            $extra = null;
                    }

                    if ($extra && isset($extra->firstName)) {
                        $_SESSION['USER']->firstName = $extra->firstName;
                        $_SESSION['USER']->user_id = $row->user_id;
                        $_SESSION['USER']->role = $row->role;
                    }
                    switch ($row->role) {
                        case "admin":
                            $_SESSION['USER']->photo_path = $extra->admin_photo_path;
                            break;
                        case "candidate":
                            $_SESSION['USER']->photo_path = $extra->candidate_photo_path;
                            break;
                        case "validator":
                            $_SESSION['USER']->photo_path = $extra->validator_photo_path;
                            break;
                        case "counselor":
                            $_SESSION['USER']->photo_path = $extra->counselor_photo_path;
                            break;
                        case "company":
                            $_SESSION['USER']->photo_path = $extra->company_photo_path;
                            $_SESSION['USER']->hr_firstName = $extra->hr_firstName;
                            break;
                    }

                    redirect('home');
                    exit;
                } else {
                    $user->errors['password'] = "Incorrect password";
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
