<?php
class Bookmark
{
    use Model;
    protected $table = 'bookmarks';
    protected $allowedColumns = [
        'bm_id',
        'user_id',
        'job_id',
        'created_at',
    ];
}
