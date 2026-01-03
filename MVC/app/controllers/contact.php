<?php
class contact
{
    use Controller;
    public function index()
    {
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'sending_feedback') {
            require_once __DIR__ . '/../core/Mailer.php';

            $fromEmail = $_POST['email'];          // sender
            $fromName  = $_POST['name'];
            $message   = $_POST['message'];

            Mailer::feedBackEmail($fromEmail, $fromName, $message);
        }
        $this->view("contact", $data);
    }
}
