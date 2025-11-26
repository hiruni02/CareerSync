<?php
class Consultation
{
    use Model;
    protected $table = 'consultation';

    protected $allowedColumns = [
        'candidate_id',
        'counselor_id',
        'mode',
        'address_link',
        'extra_details',
        'dateConfirmed'
    ];

    public function createMeeting($data, $slots)
    {
        $this->insert($data);

        $meeting = $this->query(
            "SELECT meeting_id FROM consultation 
             WHERE candidate_id=? AND counselor_id=? 
             ORDER BY meeting_id DESC LIMIT 1",
            [$data['candidate_id'], $data['counselor_id']]
        );

        if (!$meeting) return false;

        $meeting_id = $meeting[0]->meeting_id;

        $slotModel = new ConsultationSlot();

        foreach ($slots as $slot) {
            $slotModel->insert([
                'meeting_id' => $meeting_id,
                'slot_datetime' => $slot
            ]);
        }

        return $meeting_id;
    }
}
