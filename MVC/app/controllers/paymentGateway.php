<?php
class PaymentGateway
{
    use Controller;
    public function index()
    {
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;

        $data = [
            'username'    => $_SESSION['USER']->email,
            'amount'      => 2500,
            'description' => 'CareerSync Company Subscription'
        ];

        $this->view("paymentGateway", $data);
    }

    public function start()
    {
        if (!isset($_SESSION['USER'])) {
            redirect('login');
        }
        $data = [
            'amount' => 2500,
            'description' => 'CareerSync Company Subscription'
        ];
        $this->view('paymentGateway', $data);
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('dashboard');
        }

        // Simulated payment success
        $transactionRef = 'TXN_' . uniqid();
        $company = new Company();
        $company->activateSubscription($_SESSION['USER']->user_id, $transactionRef);
        redirect('dashboard');
    }
}
