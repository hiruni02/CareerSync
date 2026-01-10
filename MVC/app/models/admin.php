<?php
class Admin
{
    use Model;
    protected $table = 'admin';
    protected $allowedColumns = [
        'user_id',
        'firstName',
        'lastName',
        'contactNo',
    ];

    public function generateLast30DaysReport()
    {
        $since = date('Y-m-d H:i:s', strtotime('-30 days'));

        return [
            'new_companies'       => $this->countNewCompanies($since),
            'new_candidates'      => $this->countNewCandidates($since),
            'new_counselors'      => $this->countNewCounselors($since),
            'total_users'         => $this->countTotalUsers(),
            'active_users'        => $this->countActiveUsers(),
            'company_interviews'  => $this->countCompanyInterviews($since),
            'counselor_meetings'  => $this->countCounselorMeetings($since),
        ];
    }

    private function countNewCompanies($since)
    {
        $query = "SELECT COUNT(*) AS total
        FROM users
        WHERE role = 'company'
        AND created_at >= ?";

        return $this->query($query, [$since])[0]->total ?? 0;
    }

    private function countNewCandidates($since)
    {
        $query = "SELECT COUNT(*) AS total
        FROM users
        WHERE role = 'candidate'
        AND created_at >= ?";

        return $this->query($query, [$since])[0]->total ?? 0;
    }

    private function countNewCounselors($since)
    {
        $query = "SELECT COUNT(*) AS total
        FROM users
        WHERE role = 'counselor'
        AND created_at >= ?";

        return $this->query($query, [$since])[0]->total ?? 0;
    }

    private function countTotalUsers()
    {
        $query = "SELECT COUNT(*) AS total FROM users";
        return $this->query($query)[0]->total ?? 0;
    }

    private function countActiveUsers()
    {
        $query = "SELECT COUNT(*) AS total
        FROM users
        WHERE status = 'active'";

        return $this->query($query)[0]->total ?? 0;
    }

    private function countCompanyInterviews($since)
    {
        $query = "SELECT COUNT(DISTINCT i.interview_id) AS total
        FROM interviews i
        JOIN interview_slots s ON s.interview_id = i.interview_id
        WHERE s.slot_datetime >= ?";

        return $this->query($query, [$since])[0]->total ?? 0;
    }

    private function countCounselorMeetings($since)
    {
        $query = "SELECT COUNT(DISTINCT c.meeting_id) AS total
        FROM consultation c
        JOIN consultation_slots s ON s.meeting_id = c.meeting_id
        WHERE s.slot_datetime >= ?";

        return $this->query($query, [$since])[0]->total ?? 0;
    }

    public function getValidatorDetails()
    {
        $query = "SELECT v.*, u.email, u.status
        FROM validator v
        JOIN users u ON v.user_id = u.user_id
        WHERE u.status = 'pending'";
        
        return $this->query($query);
    }
}
