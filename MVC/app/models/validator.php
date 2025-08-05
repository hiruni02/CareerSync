<?php
class validator{
    use Model;
    protected $table = 'validator';
    protected $allowedColumns = [
        'user_id',
        'firstName',
        'lastName',
        'phoneNo',
        'nic_no',
        'nic_path',
    ];
}