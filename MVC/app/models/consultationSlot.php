<?php
class ConsultationSlot
{
    use Model;
    protected $table = 'consultation_slots';

    protected $allowedColumns = [
        'meeting_id',
        'slot_datetime'
    ];
}
