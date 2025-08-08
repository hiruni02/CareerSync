<?php
    trait Controller{
        public function view($name,$data=[]){

            // Add global admin info
            $adminModel = new Admin();
            $admin = $adminModel->first([]); // fetch first admin

            $data['admin_email'] = $admin->email ?? 'info@careersync.com';
            $data['admin_contact'] = $admin->contactNo ?? '+94 77 123 4567';

            // Extract data to make variables available in view
            if(!empty($data)){
                extract($data);
            }
            $filename = "../app/views/".$name.".view.php";
            if(file_exists($filename)){
                require $filename;
                
            }else{
                $filename = "../app/views/404.view.php";
                require $filename;
            }
        }
    }