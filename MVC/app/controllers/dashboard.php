<?php
class Dashboard
{
    use Controller;

    public function index()
    {
        // Optional: send data to the view
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $this->view("dashboard", $data);  // loads dashboard.view.php
    }
}
