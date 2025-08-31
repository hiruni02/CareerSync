<link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard/candidateDash.css">

<div class="settings_menu" id="settings_menu">
    <ul class="settings_links">
        <li><a href=""><button class="setting_btn" id="profileBtn">Your Profile</button></a></li>
        <li><a href=""><button class="setting_btn">Change Password</button></a></li>
    </ul>
</div>

<?php
include("C:/xampp/htdocs/CareerSync/MVC/app/views/profiles/candidateProfile.php");
?>

<h1 class="dashboard_tag">Candidate Dash Board</h1>
<div class="counting_boxes">
    <div class="box_segment">
        Pending applications:<br>
        <h1>23</h1>
    </div>
    <div class="box_segment">
        Accepted applications: <br>
        <h1>2</h1>
    </div>
    <div class="box_segment">
        Rejected applications: <br>
        <h1>45</h1>
    </div>
    <div class="box_segment">
        Unread messeges: <br>
        <h1>5</h1>
    </div>
</div>

<div class="content_section">
    <section>
        <div class="scrollBox">
            <table>
                <tbody>
                    <tr>
                        <td>position 1</td>
                        <td><span class="status pending">pending</span></td>
                    </tr>
                    <tr>
                        <td>position 2</td>
                        <td><span class="status rejected">rejected</span></td>
                    </tr>
                    <tr>
                        <td>position 3</td>
                        <td><span class="status rejected">rejected</span></td>
                    </tr>
                    <tr>
                        <td>position 1</td>
                        <td><span class="status pending">pending</span></td>
                    </tr>
                    <tr>
                        <td>position 2</td>
                        <td><span class="status rejected">rejected</span></td>
                    </tr>
                    <tr>
                        <td>position 3</td>
                        <td><span class="status rejected">rejected</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>  