<?php
class User
{
    use Model;
    protected $table = 'users';
    protected $allowedColumns = [
        'email',
        'password',
        'role',
        'status',
    ];

    public function getCompanyPaymentStatus($user_id)
    {
        $query = "SELECT status FROM users WHERE user_id = ? LIMIT 1";
        $result = $this->query($query, [$user_id]);

        return $result ? $result[0]->status : null;
    }
}
