<?php
class CV
{
    use Model;
    protected $table = 'cvTable';
    protected $allowedColumns = [
        'job_id',
        'candidate_id',
        'cv_file_path',
    ];

    public function SelectAll()
    {
        $query = "  SELECT 
            cvTable.*, 
            candidate.firstName, 
            candidate.lastName, 
            company.companyName
                    FROM cvTable
                    JOIN candidate ON cvTable.candidate_id = candidate.user_id
                    JOIN jobPost ON cvTable.job_id = jobPost.job_id
                    JOIN company ON jobPost.company_id = company.user_id";

        $result = $this->query($query);
        return $result ?: [];
    }
}
