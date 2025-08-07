<?php
class company{
    use Model;
    protected $table = 'company';
    protected $allowedColumns = [
        'companyname',
        'companyemail',
        'phonenumber',
    ];
}