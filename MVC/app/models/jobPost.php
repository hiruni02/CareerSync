<?php
class JobPost
{
    use Model;
    protected $table = 'jobPost';
    protected $allowedColumns = [
        'company_id',
        'posTitle',
        'posType',
        'industry',
        'exp_level',
        'yearsOfExp',
        'qualifications',
        'required_skills',
        'salaryDetails',
        'address',
        'workMode',
        'jobDescription',
        'vacancies',
        'deadline',
    ];

    public function __construct() //overriding "protected $order_column = "user_id";" in model.php
    {
        $this->order_column = "job_id";
    }
}
