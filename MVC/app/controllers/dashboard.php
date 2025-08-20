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
                //extract candidate data
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
