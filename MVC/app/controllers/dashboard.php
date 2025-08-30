<?php
class Dashboard
{
    use Controller;

    public function index()
    {
        $data['email'] = !empty($_SESSION['USER']) ? $_SESSION['USER']->email : null;

        //with this method we could extract data from the user id across all tables
        $user = new User;
        $data['userTable'] = $user->first(['user_id' => $_SESSION['USER']->user_id]);
        switch ($_SESSION['USER']->role) {
            case 'admin':
                //extract admin data
                $admin = new Admin;
                $data['adminTable'] = $admin->first(['user_id' => $_SESSION['USER']->user_id]);
                break;
            case 'candidate':
                //extract candidate data
                break;
            case 'company':
                $company = new Company;
                $data['companyTable'] = $company->first(['user_id' => $_SESSION['USER']->user_id]);

                // Handle profile update
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProfile'])) {
                    $updateData = [
                        'companyName'    => $_POST['companyName'] ?? '',
                        //'company_email'   => $_POST['company_email'] ?? '',
                        'contactNo'  => $_POST['contactNo'] ?? '',
                        'hr_firstname'   => $_POST['hr_firstname'] ?? '',
                        'hr_lastname'    => $_POST['hr_lastname'] ?? '',
                        'hr_email'        => $_POST['hr_email'] ?? '',
                        'hr_contactNo' => $_POST['hr_contactNo'] ?? '',
                    ];
                    /*if (!empty($_FILES['company_logo']['name'])) {
                        $fileName   = time() . "_" . basename($_FILES['company_logo']['name']);
                        $targetPath = "uploads/company_logos/" . $fileName;

                        if (move_uploaded_file($_FILES['company_logo']['tmp_name'], $targetPath)) {
                            $updateData['company_logo'] = $fileName;
                        }
                    }*/
                    if (!empty($_FILES['business_certificate']['name'])) {
                        $fileName   = time() . "_" . basename($_FILES['business_certificate']['name']);
                        $targetPath = "uploads/company_docs/" . $fileName;

                        if (move_uploaded_file($_FILES['business_certificate']['tmp_name'], $targetPath)) {
                            $updateData['business_certificate'] = $fileName;
                        }
                    }                    
                    $company->update($data['companyTable']->company_id, $updateData);
                    $data['companyTable'] = $company->first(['user_id' => $_SESSION['USER']->user_id]);                  
                    header("Location: " . ROOT . "dashboard");
                    exit;
                }
                break;

            case 'validator':
                //extract validator data
                break;
            case 'counselor':
                //extract counselor data
                break;
        }

        $this->view("dashboard", $data);  // loads dashboard.view.php
    }
}
