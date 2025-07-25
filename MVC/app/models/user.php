<?php
class User{
    use Model;
    protected $table = 'users';
    protected $allowedColumns = [
        'email',
        'password',
        'role',
        'status',
        'created_at'
    ];
}