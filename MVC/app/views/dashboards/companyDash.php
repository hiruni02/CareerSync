<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/companyDash.css">

<div class="settings_menu" id="settings_menu">
    <ul class="settings_links">
        <li><button class="setting_btn" id="profileBtn">Company Profile</button></li>
        <li><a href=""><button class="setting_btn">Change Password</button></a></li>
    </ul>
</div>

<?php
include("C:/xampp/htdocs/CareerSync/MVC/app/views/profiles/companyProfile.php");
?>

<h1 class="dashboard_tag">Company Dashboard</h1>

<div class="counting_boxes">
    <div class="box_segment">
        Posted Jobs: <br>
        <h1>15</h1>
    </div>
    <div class="box_segment">
        Active Applications: <br>
        <h1>42</h1>
    </div>
    <div class="box_segment">
        Shortlisted Candidates: <br>
        <h1>12</h1>
    </div>
    <div class="box_segment">
        Pending Interviews: <br>
        <h1>8</h1>
    </div>
    <div class="box_segment">
        Feedback Received: <br>
        <h1>5</h1>
    </div>
</div>

<div class="content_section">
    <section>
        <table>
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Candidate</th>
                    <th>Status</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Job Title">Software Engineer</td>
                    <td data-label="Candidate">John Doe</td>
                    <td data-label="Status">Pending Interview</td>
                    <td data-label="Email">johndoe@gmail.com</td>
                </tr>
                <tr>
                    <td data-label="Job Title">UI/UX Designer</td>
                    <td data-label="Candidate">Jane Smith</td>
                    <td data-label="Status">Shortlisted</td>
                    <td data-label="Email">jane@gmail.com</td>
                </tr>
                <tr>
                    <td data-label="Job Title">Data Analyst</td>
                    <td data-label="Candidate">Michael Lee</td>
                    <td data-label="Status">Application Received</td>
                    <td data-label="Email">mlee@gmail.com</td>
                </tr>
                <tr>
                    <td data-label="Job Title">HR Manager</td>
                    <td data-label="Candidate">Emily Davis</td>
                    <td data-label="Status">Pending Interview</td>
                    <td data-label="Email">emilyd@gmail.com</td>
                </tr>
            </tbody>
        </table>
    </section>
</div>


