<?php
class company{
    use Model;
    protected $table = 'company';
    protected $allowedColumns = [
        'company',
        'lastName',
        'nic_no',
    ];
}