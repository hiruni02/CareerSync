<?php
class PaymentGateway
{
    use Controller;

    public function index()
    {
        if (!isset($_SESSION['USER'])) {
            redirect('login');
        }

        $data = [
            'username'    => $_SESSION['USER']->email,
            'amount'      => "5000.00",
            'description' => 'CareerSync Company Subscription'
        ];

        $this->view("paymentGateway", $data);
    }

    public function hash()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
            exit;
        }

        $merchant_id = "1233775"; // Your sandbox merchant ID
        $merchant_secret = "MjgxNzM0NTQzMDg1OTU0Mjc1NTIzOTAyMTMzMDIyNzAzMDIxMzg0"; // Your sandbox secret

        $order_id = $_POST['order_id'] ?? '';
        $amount = number_format($_POST['amount'] ?? 0, 2, '.', '');
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id .
                $order_id .
                $amount .
                $currency .
                strtoupper(md5($merchant_secret))
            )
        );

        echo json_encode(["hash" => $hash]);
        exit;
    }

    public function success()
    {
        $transactionRef = 'TXN_' . uniqid();

        $company = new Company();
        $company->activateSubscription($_SESSION['USER']->user_id, $transactionRef);

        redirect('dashboard');
    }
}
