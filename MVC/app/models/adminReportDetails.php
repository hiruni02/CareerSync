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
}
