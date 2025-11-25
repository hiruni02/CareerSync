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

    public function getMeetingRequest($counselor_id)
    {
        $query =
            "SELECT cr.*, 
                    c.firstName AS candidate_firstName,
                    c.lastName AS candidate_lastName,
                    c.candidate_photo_path
             FROM counselor_requests cr
             JOIN candidate c ON c.user_id = cr.candidate_id
             WHERE cr.counselor_id = ?";

        return $this->query($query, [$counselor_id]);
    }
}
