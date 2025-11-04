<?php
class InterviewSlot
{
    use Model;
    protected $table = 'interview_slots';
    protected $allowedColumns = ['interview_id', 'slot_datetime'];
}
