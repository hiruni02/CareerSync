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
        if($job_apply){
            //code for storing CV in the database
        }

        $data['job'] = $jobData;
        $this->view("jobdetails", $data);
    }
}
