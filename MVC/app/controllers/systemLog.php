<?php
class systemLog
{
    use Controller;
    public function index()
    {
        //if not logged in the $username variable is deafulted to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $admin = new Admin;
        $data['syslogs'] = $admin->getSystemLogs();

        $this->view("systemLog", $data);
    }
}
