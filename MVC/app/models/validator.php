<?php
class Validator{
    use Model;
    protected $table = 'validator';
    protected $allowedColumns = [
        'user_id',
        'firstName',
        'lastName',
        'contactNo',
        'nic_no',
        'nic_path',
    ];
}