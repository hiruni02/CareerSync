<?php

class AdminReportDetails
{
    use Model;
    protected $table = 'admin_reports';
    protected $allowedColumns = [
        'report_month',
        'report_month_name',
        'prepared_by',
        'generated_at',
        'new_companies',
        'new_candidates',
        'new_counselors',
        'total_users',
        'active_users',
        'feedback_count',
        'company_interviews',
        'counselor_meetings',
        'total_earnings',
        'system_alerts'
    ];

    public function selectOldReports()
    {
        $query = "SELECT * FROM admin_reports";
        return $this->query($query);
    }

    public function saveReportDetails($preparedBy)
    {
        $startDate = date('Y-m-d H:i:s', strtotime('-30 days'));
        $endDate   = date('Y-m-d H:i:s');

        $month = date('Y-m');
        $existing = $this->first(['report_month' => $month]);
        if ($existing) {
            return false;
        }

        $totalUsers = $this->query(
            "SELECT COUNT(*) AS c FROM users"
        )[0]->c;

        $activeUsers = $this->query(
            "SELECT COUNT(*) AS c FROM users WHERE status = 'active'"
        )[0]->c;

        $newCompanies = $this->query(
            "SELECT COUNT(*) AS c FROM users 
         WHERE role = 'company' AND created_at >= ?",
            [$startDate]
        )[0]->c;

        $newCandidates = $this->query(
            "SELECT COUNT(*) AS c FROM users 
         WHERE role = 'candidate' AND created_at >= ?",
            [$startDate]
        )[0]->c;

        $newCounselors = $this->query(
            "SELECT COUNT(*) AS c FROM users 
         WHERE role = 'counselor' AND created_at >= ?",
            [$startDate]
        )[0]->c;

        $companyInterviews = $this->query(
            "SELECT COUNT(*) AS c FROM interviews"
        )[0]->c;

        $counselorMeetings = $this->query(
            "SELECT COUNT(*) AS c FROM consultation"
        )[0]->c;

        // $feedbackCount = 0; // feedback table NOT defined
        // $totalEarnings = 0; // no payments table
        // $systemAlerts  = 0; // alerts table not defined

        $data = [
            'report_month'       => $month,
            'report_month_name'  => date('F Y'),
            'prepared_by'        => $preparedBy,
            'generated_at'       => date('Y-m-d H:i:s'),
            'new_companies'      => $newCompanies,
            'new_candidates'     => $newCandidates,
            'new_counselors'     => $newCounselors,
            'total_users'        => $totalUsers,
            'active_users'       => $activeUsers,
            'feedback_count'     => 0, 
            'company_interviews' => $companyInterviews,
            'counselor_meetings' => $counselorMeetings,
            'total_earnings'     => 0.00,
            'system_alerts'      => 0
        ];

        return $this->insert($data);
    }
}
