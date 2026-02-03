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

    public function getValidatorDetails()
    {
        $query = "SELECT v.*, u.email, u.status
                FROM validator v
                JOIN users u ON v.user_id = u.user_id
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
}
