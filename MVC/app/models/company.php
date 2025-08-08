<?php
class Company{
    use Model;
    protected $table = 'company';
    protected $allowedColumns = [
        'companyname',
        'companyemail',
        'phonenumber',
    ];
}