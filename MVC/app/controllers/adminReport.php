<?php
class AdminReport
{
    use Controller;
    public function index()
    {
        //if not logged in the $username variable is deafulted to 'User'
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $reportModel = new Admin();
        $data['reportData'] = $reportModel->generateLast30DaysReport();

        $this->view("adminReport", $data);
    }
}
