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
}
