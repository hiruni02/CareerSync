<?php
class CounselorRequest
{
    use Model;
    protected $table = 'counselor_requests';

    protected $allowedColumns = [
        'candidate_id',
        'counselor_id',
        'counselor_acceptance',
        'created_at'
    ];
}
