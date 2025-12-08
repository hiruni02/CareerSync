<?php
class Interview
{
    use Model;
    protected $table = 'interviews';
    protected $allowedColumns = [
        'candidate_id',
        'company_id',
        'job_id',
        'mode',
        'address_link',
        'extra_details',
        'dateConfirmed',
    ];

    public function getCandidateInterview($candidate_id)
    {
        // Fetch interview details
        $query = "SELECT i.*
              FROM interviews i
              WHERE i.candidate_id = ?
              LIMIT 1";
        $interview = $this->query($query, [$candidate_id]);
        $interviewData = $interview ? $interview[0] : null;

        // Fetch interview slots if interview exists
        $slots = [];
        if ($interviewData) {
            $slotQuery = "SELECT slot_datetime
                      FROM interview_slots
                      WHERE interview_id = ?";
            $slots = $this->query($slotQuery, [$interviewData->interview_id]);
        }

        return [
            'interviewData' => $interviewData,
            'slots' => $slots
        ];
    }


    public function createInterview($data, $slots)
    {
        $this->insert($data);

        $result = $this->query(
            "SELECT interview_id 
            FROM interviews 
            WHERE candidate_id = ? 
            AND company_id = ? 
            ORDER BY interview_id DESC 
            LIMIT 1",
            [$data['candidate_id'], $data['company_id']]
        );

        if (!$result || !isset($result[0]->interview_id)) {
            throw new Exception("Interview ID not found after insert");
        }

        $interview_id = $result[0]->interview_id;

        $slotModel = new InterviewSlot();
        foreach ($slots as $slot) {
            $slotModel->insert([
                'interview_id'  => $interview_id,
                'slot_datetime' => date('Y-m-d H:i:s', strtotime($slot))
            ]);
        }

        return true;
    }

    public function getInterviewsByCandidate($candidate_id)
    {
        $query = "SELECT 
                jobPost.posTitle,
                company.companyName,
                interview_slots.slot_datetime,
                interviews.mode,
                interviews.address_link,
                cvTable.cv_file_path
                FROM interviews
                INNER JOIN interview_slots 
                ON interviews.interview_id = interview_slots.interview_id
                INNER JOIN company 
                ON interviews.company_id = company.user_id
                INNER JOIN cvTable 
                ON interviews.candidate_id = cvTable.candidate_id
                INNER JOIN jobPost 
                ON cvTable.job_id = jobPost.job_id
                WHERE interviews.candidate_id = ?
                AND interviews.dateConfirmed = 'confirmed'";

        return $this->query($query, [$candidate_id]);
    }

    public function getInterviewsByCompany($company_id)
    {
        $query = "SELECT 
            jobPost.posTitle,
            CONCAT(candidate.firstName, ' ', candidate.lastName) AS candidateName,
            interview_slots.slot_datetime,
            interviews.mode,
            interviews.address_link,
            cvTable.cv_file_path
            FROM interviews
            INNER JOIN jobPost 
            ON interviews.job_id = jobPost.job_id
            INNER JOIN candidate 
            ON interviews.candidate_id = candidate.user_id
            INNER JOIN interview_slots 
            ON interviews.interview_id = interview_slots.interview_id
            INNER JOIN cvTable
            ON interviews.candidate_id = cvTable.candidate_id
            AND interviews.job_id = cvTable.job_id
            WHERE interviews.company_id = ?
            AND interviews.dateConfirmed = 'confirmed'
            ORDER BY interview_slots.slot_datetime ASC";

        return $this->query($query, [$company_id]);
    }
}
