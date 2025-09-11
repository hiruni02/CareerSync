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

    public function SelectAll()
    {
        $query = "SELECT jobPost.*, company.company_photo_path, company.companyName
              FROM jobPost
              JOIN company ON jobPost.company_id = company.user_id
              ORDER BY $this->order_column $this->order_type
              LIMIT $this->limit OFFSET $this->offset";

        return $this->query($query);
    }

    public function __construct() //overriding "protected $order_column = "user_id";" in model.php
    {
        $this->order_column = "job_id";
    }
}
