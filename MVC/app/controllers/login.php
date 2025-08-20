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
                            break;
                        case 'candidate':
                            $candidate = new Candidate();
                            $extra = $candidate->first(['user_id' => $row->user_id]);
                            break;
                        case 'counselor':
                            $counselor = new Counselor();
                            $extra = $counselor->first(['user_id' => $row->user_id]);
                            break;
                        case 'validator':
                            $validator = new Validator();
                            $extra = $validator->first(['user_id' => $row->user_id]);
                            break;
                        case 'company':
                            $company = new Company();
                            $extra = $company->first(['user_id' => $row->user_id]);
                            break;
                        default:
                            $extra = null;
                    }

                    if ($extra && isset($extra->firstName)) {
                        $_SESSION['USER']->firstName = $extra->firstName;
                        $_SESSION['USER']->user_id = $row->user_id;
                        $_SESSION['USER']->role = $row->role;
                    }

                    // For companies, use HR's first name for display
                    if ($extra) {
                        if ($row->role === 'company') {
                            $_SESSION['USER']->hr_firstName = $extra->hr_firstName;
                        } else {
                            $_SESSION['USER']->firstName = $extra->firstName;
                        }
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
