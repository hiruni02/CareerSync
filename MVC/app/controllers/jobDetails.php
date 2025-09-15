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

        $data['job'] = $jobData;
        $this->view("jobdetails", $data);
    }
}
