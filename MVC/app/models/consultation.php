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
            AND consultation.dateConfirmed = 'unconfirmed'
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

    public function getConfirmedConsultationsForCounselor($counselor_id)
    {
        $query = "SELECT 
                c.meeting_id,
                c.mode,
                c.address_link,
                c.extra_details,
                c.dateConfirmed,
                candidate.firstName AS candidate_first_name,
                candidate.lastName AS candidate_last_name,
                cs.slot_datetime
            FROM consultation c
            INNER JOIN candidate
                ON c.candidate_id = candidate.user_id
            LEFT JOIN consultation_slots cs
                ON c.meeting_id = cs.meeting_id
            WHERE c.counselor_id = ?
            AND c.dateConfirmed = 'confirmed'
            ORDER BY cs.slot_datetime ASC";

        return $this->query($query, [$counselor_id]);
    }

    public function getConfirmedConsultationsForCandidate($candidate_id)
    {
        $query = "SELECT 
                c.meeting_id,
                c.mode,
                c.address_link,
                c.extra_details,
                c.dateConfirmed,
                counselor.firstName AS counselor_first_name,
                counselor.lastName AS counselor_last_name,
                cs.slot_datetime
            FROM consultation c
            INNER JOIN counselor
                ON c.counselor_id = counselor.user_id
            LEFT JOIN consultation_slots cs
                ON c.meeting_id = cs.meeting_id
            WHERE c.candidate_id = ?
            AND c.dateConfirmed = 'confirmed'
            ORDER BY cs.slot_datetime ASC";

        return $this->query($query, [$candidate_id]);
    }
}
