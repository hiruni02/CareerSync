<?php
class Company {
    use Model;
    protected $table = 'company';
    protected $allowedColumns = [
        'user_id',
        'companyname',
        'email',                // matches company email input
        'contactNo',
        'hr_name',
        'hr_email',
        'hr_contact',
        'business_certificate', // file name/path for uploaded certificate
        'password',             // hashed password
    ];
}
