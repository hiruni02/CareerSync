<?php
class Admin{
    use Model;
    protected $table = 'admin';
    protected $allowedColumns = [
        'user_id',
        'firstName',
        'lastName',
        'contactNo',
    ];
}