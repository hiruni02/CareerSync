<?php
class CounselorMeetings
{
    use Model;
    protected $table = 'counselorMeetings';

    protected $allowedColumns = [
        'candidate_id',
        'counselor_id',
        'mode',
        'address_link',
        'extra_details',
        'dateConfirmed'
    ];
}
