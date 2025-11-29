<?php
class Home
{
    use Controller;
    use Database;
    public function index()
    {
        //if not logged in the $username variable is deafulted to 'User'
        if (empty($_SESSION['USER'])) {
            $data['username'] = 'User';
        } else {
            if ($_SESSION['USER']->role !== 'company') {
                $data['username'] = $_SESSION['USER']->firstName;
            } else {
                $data['username'] = $_SESSION['USER']->hr_firstName;
            }
        }
        $user = new User;
        $user->CreateTables();

        $jobPost = new JobPost;
        $data['jobs'] = $jobPost->SelectAll();

        $job = new JobPost;

        $filters = [
            'minSalary'  => $_GET['minSalary'] ?? null,
            'maxSalary'  => $_GET['maxSalary'] ?? null,
            'sortBy'     => $_GET['sortBy'] ?? null,
            'city'       => $_GET['city'] ?? null,
            'workMode'   => $_GET['workMode'] ?? null,
            'jobType'    => $_GET['jobType'] ?? null,
            'experience' => $_GET['experience'] ?? null,
        ];

        $data['jobs'] = $job->getFilteredJobs($filters);

        $this->view("home", $data);
    }
}
    #if you need to load a view, there must be a controller for that view in the controller folder calling the view functuon from the Controller class
    #And that will load a the [view name].view.php or it will load the error 404 view.
