<?php
class CounselorMeetingSlots
{
    use Model;
    protected $table = 'counselorMeeting_slots';

    protected $allowedColumns = [
        'meeting_id',
        'slot_datetime'
    ];
}
