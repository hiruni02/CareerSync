<?php
class Company
{
    use Model;
    protected $table = 'company';
    protected $allowedColumns = [
        'user_id',
        'companyName',
        'contactNo',
        'hr_firstName',
        'hr_lastName',
        'hr_email',
        'hr_contactNo',
        'business_certificate',
        'company_photo_path',
    ];

    public function activateSubscription($userId, $transactionRef)
    {
        $query = "UPDATE company 
        SET payment_status = 'active',
            transaction_ref = ?,
            paid_at = NOW()
        WHERE user_id = ?";

        $this->query($query, [$transactionRef, $userId]);
    }
}
