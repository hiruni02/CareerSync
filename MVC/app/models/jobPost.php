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
        'city',
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

    public function jobpost_and_company($id)
    {
        $query = "SELECT jobPost.*, company.*
              FROM jobPost
              JOIN company ON jobPost.company_id = company.user_id
              WHERE jobPost.job_id = ?
              LIMIT 1";

        $params = [$id];
        $result = $this->query($query, $params);
        return $result ? $result[0] : null;
    }

    public function __construct() //overriding "protected $order_column = "user_id";" in model.php
    {
        $this->order_column = "job_id";
    }

    public function getFilteredJobs($salary, $sort)
    {
        $query = "SELECT jobPost.*, company.company_photo_path, company.companyName
              FROM jobPost
              JOIN company ON jobPost.company_id = company.user_id
              WHERE 1";

        $params = [];

        // Salary filter
        if (!empty($salary)) {
            $query .= " AND jobPost.salaryDetails >= ?";
            $params[] = $salary;
        }

        // Sorting
        switch ($sort) {
            case 'asc':
                $query .= " ORDER BY jobPost.posTitle ASC";
                break;

            case 'desc':
                $query .= " ORDER BY jobPost.posTitle DESC";
                break;

            case 'highsalary':
                $query .= " ORDER BY jobPost.salaryDetails DESC";
                break;

            case 'lowsalary':
                $query .= " ORDER BY jobPost.salaryDetails ASC";
                break;

            default:
                $query .= " ORDER BY jobPost.job_id DESC"; // default listing
                break;
        }

        // Execute with MySQLi wrapper
        return $this->query($query, $params);
    }
}
