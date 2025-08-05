<?php
class validator{
    use Model;
    protected $table = 'validator';
    protected $allowedColumns = [
        'firstName',
        'lastName',
        'nic_no',
    ];
}