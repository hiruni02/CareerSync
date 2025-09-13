<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/counselorDash.css">

<div class="settings_menu" id="settings_menu">
    <ul class="settings_links">
        <li><a href=""><button class="setting_btn" id="profileBtn">Your Profile</button></a></li>
        <li><a href=""><button class="setting_btn" id="passwordBtn">Change Password</button></a></li>
    </ul>
</div>

<?php
include("C:/xampp/htdocs/CareerSync/MVC/app/views/components/changePassword.php");
include("C:/xampp/htdocs/CareerSync/MVC/app/views/profiles/counselorProfile.php");
?>

<h1 class="dashboard_tag">Counselor Dashboard</h1>

<div class="counting_boxes">
    <div class="box_segment">
        Assigned Students:<br>
        <h1>35</h1>
    </div>
    <div class="box_segment">
        Scheduled Sessions: <br>
        <h1>12</h1>
    </div>
    <div class="box_segment">
        Pending Approvals: <br>
        <h1>5</h1>
    </div>
    <div class="box_segment">
        Messages: <br>
        <h1>8</h1>
    </div>
    <div class="box_segment">
        Feedback Received: <br>
        <h1>3</h1>
    </div>
</div>

<div class="content_section">
    <div class='Clients'>
        <h1>Clients</h1>
        <div class="scrollBox">
            <ul class="applications">
                <li class="application_item">
                    <div class="application-title">Kavi</div>
                    <div class="application_state"><span class="status requested">requested</span></div>
                </li>
                <li class="application_item">
                    <div class="application-title">Suman</div>
                    <div class="application_state"><span class="status completed">completed</span></div>
                </li>
                <li class="application_item">
                    <div class="application-title">Lisa</div>
                    <div class="application_state"><span class="status pending">pending</span></div>
                </li>
                <li class="application_item">
                    <div class="application-title">Rahul</div>
                    <div class="application_state"><span class="status completed">completed</span></div>
                </li>
                <li class="application_item">
                    <div class="application-title">Yohan</div>
                    <div class="application_state"><span class="status pending">pending</span></div>
                </li>
            </ul>
        </div>
    </div>
</div>