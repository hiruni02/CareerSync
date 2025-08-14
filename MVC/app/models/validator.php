<?php
class Validator
{
    use Model;
    protected $table = 'validator';
    protected $allowedColumns = [
        'user_id',
        'firstName',
        'lastName',
        'contactNo',
        'validator_photo_path',
    ];
}
