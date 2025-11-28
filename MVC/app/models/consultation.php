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

    public function getConsultationDetails($candidate_id)
    {
        $query = "SELECT 
                cr.request_id,
                cr.counselor_acceptance,
                counselor.firstName,
                counselor.lastName,
                consultation.meeting_id,
                consultation.mode,
                consultation.address_link,
                consultation.extra_details,
                cs.slot_datetime
            FROM consultation_requests cr
            INNER JOIN counselor
                ON cr.counselor_id = counselor.user_id
            LEFT JOIN consultation
                ON cr.candidate_id = consultation.candidate_id
               AND cr.counselor_id = consultation.counselor_id
            LEFT JOIN consultation_slots cs
                ON consultation.meeting_id = cs.meeting_id
               AND cs.slot_datetime = (
                    SELECT MIN(slot_datetime)
                    FROM consultation_slots
                    WHERE meeting_id = consultation.meeting_id
               )
            WHERE cr.candidate_id = ?
            ORDER BY cr.request_id DESC";

        return $this->query($query, [$candidate_id]);
    }

    public function getCandidateConsultation($candidate_id)
    {
        // fetch meeting record (the latest one for candidate)
        $query = "SELECT * FROM consultation WHERE candidate_id = ? LIMIT 1";
        $meeting = $this->query($query, [$candidate_id]);

        $meetingData = $meeting ? $meeting[0] : null;
        $slots = [];

        if ($meetingData) {
            $slotQuery = "SELECT slot_datetime FROM consultation_slots WHERE meeting_id = ?";
            $slots = $this->query($slotQuery, [$meetingData->meeting_id]);
        }

        return [
            'meetingData' => $meetingData,
            'slots'       => $slots
        ];
    }
}
