<?php
class JobDetails
{
    use Controller;
    public function index($id = null)
    {
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        if (!$id) {
            redirect('home'); // if no job id, go back to home
        }

        $job = new JobPost;
        $jobData = $job->jobpost_and_company($id);

        if (!$jobData) {
            $this->view("404");
            return;
        }

        $job_apply = ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'job_apply');
        if ($job_apply) {
            //code for storing CV in the database
            $cv = new CV;
            $cv_upload_path = 'assets/uploads/cv/';

            $cv_filename = time() . '_' . basename($_FILES['cv_file_path']['name']);
            $cv_target = $cv_upload_path . $cv_filename;

            if (move_uploaded_file($_FILES['cv_file_path']['tmp_name'], $cv_target)) {

                $cvData = [
                    'job_id'        => $jobData->job_id,
                    'candidate_id'  => $_SESSION['USER']->user_id,
                    'cv_file_path'  => $cv_target,
                ];

                $cv->insert($cvData);

                redirect('dashboard');
                exit;
            }
        }

        $data['job'] = $jobData;

        $alreadyApplied = false;

        if (!empty($_SESSION['USER']) && $_SESSION['USER']->role === 'candidate') {
            $cv = new CV;
            $existingCV = $cv->first([
                'job_id' => $jobData->job_id,
                'candidate_id' => $_SESSION['USER']->user_id
            ]);

            if ($existingCV) {
                $alreadyApplied = true;
            }
        }

        $data['alreadyApplied'] = $alreadyApplied;

        $this->view("jobdetails", $data);
    }
}
