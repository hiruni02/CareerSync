<?php
class CareerCounselor {
    use Model;

    protected $table = 'career_counselors';

    protected $allowedColumns = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'nic',
        'proof_file',
        'certificate_file',
    ];
}
