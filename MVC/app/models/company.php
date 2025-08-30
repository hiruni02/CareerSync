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
}
