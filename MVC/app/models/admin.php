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
        'admin_photo_path',
    ];

    public function getValidatorDetails()
    {
        $query = "SELECT v.*, u.email, u.status
                FROM validator v
                JOIN users u ON v.user_id = u.user_id";

        return $this->query($query);
    }

    public function getCandidateDetails()
    {
        $query = "SELECT c.*, u.email, u.status
                FROM candidate c
                JOIN users u ON c.user_id = u.user_id
                WHERE u.status = 'pending'";

        return $this->query($query);
    }

    public function getSystemLogs()
    {
        $query = "SELECT * FROM system_logs
                ORDER BY created_at ASC";

        return $this->query($query);
    }

    public function getSysAlerts(){
        $query = "SELECT * FROM system_logs 
                WHERE action = 'ALERT'
                ORDER BY  created_at";
        return $this->query($query);
    }

    public function getTotalUsers()
    {
        $query = "SELECT COUNT(*) AS total FROM users";
        $result = $this->query($query);

        return $result[0]->total ?? 0;
    }

    public function getActiveUsers()
    {
        $query = "SELECT COUNT(*) AS total FROM users
        WHERE status = 'active'";
        $result = $this->query($query);

        return $result[0]->total ?? 0;
    }

    public function getSystemAlertCount()
    {
        $query = "SELECT COUNT(*) AS total FROM system_logs
                WHERE action = 'ALERT'";
        $result = $this->query($query);

        return $result[0]->total ?? 0;
    }

    public function getTotalJobPosts()
    {
        $query = "SELECT COUNT(*) AS total FROM jobPost";
        $result = $this->query($query);

        return $result[0]->total ?? 0;
    }

    public function getCounselorDetails()
    {
        $query = "SELECT c.*, u.email, u.status
                FROM counselor c
                JOIN users u ON c.user_id = u.user_id";

        return $this->query($query);
    }

    public function getCompanyDetails()
    {
        $query = "SELECT c.*, u.email, u.status
                FROM company c
                JOIN users u ON c.user_id = u.user_id";

        return $this->query($query);
    }
}
