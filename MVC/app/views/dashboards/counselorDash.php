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
    <section>
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Student Name">Kavi</td>
                    <td data-label="Email">kavi@student.com</td>
                    <td data-label="Status">Session Scheduled</td>
                </tr>
                <tr>
                    <td data-label="Student Name">John</td>
                    <td data-label="Email">john@student.com</td>
                    <td data-label="Status">Pending Approval</td>
                </tr>
                <tr>
                    <td data-label="Student Name">Ryan</td>
                    <td data-label="Email">ryan@student.com</td>
                    <td data-label="Status">Awaiting Feedback</td>
                </tr>
                <tr>
                    <td data-label="Student Name">Peter</td>
                    <td data-label="Email">peter@student.com</td>
                    <td data-label="Status">Completed</td>
                </tr>
            </tbody>
        </table>
    </section>
</div>